<?php include("connection.php"); ?>
<?php
// process_sale.php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate a unique transaction ID (could be timestamp-based or any unique identifier)
$transaction_id = time();

$medicines = json_decode($_POST['medicines'], true);

if ($medicines && is_array($medicines)) {
    $conn->begin_transaction();
    $allItemsAvailable = true;

    foreach ($medicines as $id => $medicine) {
        $quantity = $medicine['selectedQuantity'];
        $total = $medicine['total'];

        // Check if the stock quantity is sufficient
        $checkStock = $conn->prepare("SELECT quantity, name, price, expiry_date FROM medicine_stock WHERE id = ?");
        $checkStock->bind_param("i", $id);
        $checkStock->execute();
        $result = $checkStock->get_result();
        $stock = $result->fetch_assoc();

        if ($stock['quantity'] < $quantity) {
            $allItemsAvailable = false;
            break;
        }
    }

    if ($allItemsAvailable) {
        foreach ($medicines as $id => $medicine) {
            $quantity = $medicine['selectedQuantity'];
            $total = $medicine['total'];

            // Update stock quantity
            $updateStock = $conn->prepare("UPDATE medicine_stock SET quantity = quantity - ? WHERE id = ?");
            $updateStock->bind_param("ii", $quantity, $id);
            $updateStock->execute();

            // Insert into sold items with the transaction ID
            $insertSold = $conn->prepare("INSERT INTO sold_items (transaction_id, medicine_id, quantity, total) VALUES (?, ?, ?, ?)");
            $insertSold->bind_param("iiid", $transaction_id, $id, $quantity, $total);
            $insertSold->execute();

            // Check if the stock quantity is zero and move to out_of_stock if necessary
            $checkStock = $conn->prepare("SELECT quantity, name, price, expiry_date FROM medicine_stock WHERE id = ?");
            $checkStock->bind_param("i", $id);
            $checkStock->execute();
            $result = $checkStock->get_result();
            $stock = $result->fetch_assoc();

            if ($stock['quantity'] == 0) {
                // Insert into out_of_stock table
                $insertOutOfStock = $conn->prepare("INSERT INTO out_of_stock (id, name, price, expiry_date, quantity) VALUES (?, ?, ?, ?, ?)");
                $insertOutOfStock->bind_param("isdsi", $id, $stock['name'], $stock['price'], $stock['expiry_date'], $stock['quantity']);
                $insertOutOfStock->execute();

                // Delete from medicine_stock table
                $deleteStock = $conn->prepare("DELETE FROM medicine_stock WHERE id = ?");
                $deleteStock->bind_param("i", $id);
                $deleteStock->execute();
            }
        }

        $conn->commit();
        echo "Sale completed and stock updated.";
    } else {
        $conn->rollback();
        echo "Error: One or more items are out of stock.";
    }
} else {
    echo "Error: Invalid data received.";
}

$conn->close();
?>
