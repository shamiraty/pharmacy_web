<?php include("connection.php"); ?>
<?php
// process_sale.php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$medicines = $_POST['medicines'];

foreach ($medicines as $id => $medicine) {
    $quantity = $medicine['selectedQuantity'];
    $total = $medicine['total'];

    // Update stock quantity
    $updateStock = $conn->prepare("UPDATE medicine_stock SET quantity = quantity - ? WHERE id = ?");
    $updateStock->bind_param("ii", $quantity, $id);
    $updateStock->execute();

    // Insert into sold items
    $insertSold = $conn->prepare("INSERT INTO sold_items (medicine_id, quantity, total) VALUES (?, ?, ?)");
    $insertSold->bind_param("iid", $id, $quantity, $total);
    $insertSold->execute();
}

echo "Sale completed and stock updated.";

$conn->close();
?>
