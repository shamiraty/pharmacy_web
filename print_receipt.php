<?php include("nav.php"); ?>
<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {          
            background-color: #f8f9fa;
        }
        article {
            margin: 3px auto;
            text-align: center; /* Center align content */
        }
        .receipt-content {
            display: inline-block;
            text-align: left;
            width: 100%;
            max-width: 700px; /* Set max width for responsiveness */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-header img {
            max-width: 100px;
        }
        .table {
            margin-bottom: 20px;
        }
        .text-right {
            text-align: right;
        }
        .print-icon {
            cursor: pointer;
            font-size: 24px;
            color: #007bff; /* Blue color */
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
<article>
    <?php
    // Fetch the last transaction ID
    $sql = "SELECT transaction_id FROM sold_items ORDER BY transaction_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error fetching transaction ID: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    $transaction_id = $row['transaction_id'];

    // Fetch all items for the last transaction
    $sql_items = "SELECT sold_items.medicine_id, sold_items.quantity, sold_items.total, 
                         medicine_stock.name, medicine_stock.price 
                  FROM sold_items 
                  JOIN medicine_stock ON sold_items.medicine_id = medicine_stock.id 
                  WHERE sold_items.transaction_id = ?";
    $stmt = $conn->prepare($sql_items);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $result_items = $stmt->get_result();

    $transaction_items = array();
    $grand_total = 0;

    while ($row_item = $result_items->fetch_assoc()) {
        $transaction_items[] = $row_item;
        $grand_total += $row_item['total'];
    }

    $tax = $grand_total * 0.18;
    $grand_total_with_tax = $grand_total + $tax;

    $conn->close();
    ?>

    <!-- Receipt content -->
    <div class="receipt-content shadow card">
        <span class="print-icon" onclick="printReceipt()"><i class="fas fa-print"></i></span>
        <div class="receipt-header">
            <img src="images/company_logo.png" alt="Company Logo" class="w-100">
            <h1>WalMart Pharmacy</h1>
            <hr class="text-success">
            <p>1234 Uhindini Street, Dodoma, Tanzania</p>
            <p>Phone: (255) 675-7839840</p>
        </div>

        <div>
            <p><strong>Transaction Date:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
            <p><strong>Transaction Number:</strong> <?php echo $transaction_id; ?></p>
        </div>

        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price per Unit</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaction_items as $item) : ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['total'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-right">
            <p><strong>Grand Total:</strong> <?php echo number_format($grand_total, 2); ?></p>
            <p><strong>Tax (18%):</strong> <?php echo number_format($tax, 2); ?></p>
            <p><strong>Total Amount Due:</strong> <?php echo number_format($grand_total_with_tax, 2); ?></p>
        </div>
    </div>
</article>

<script>
    function printReceipt() {
        window.print();
    }
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
