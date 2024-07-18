<?php include("nav.php"); ?>
<?php include("connection.php"); ?>

<?php

// Function to fetch data from medicine_stock
function fetchMedicineStockData($conn) {
    $sql = "SELECT COUNT(*) AS total_items, SUM(price) AS total_price, SUM(quantity) AS total_quantity FROM medicine_stock";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Function to fetch data from sold_items
function fetchSoldItemsData($conn) {
    $sql = "SELECT COUNT(*) AS total_sold_items, SUM(total) AS total_sold_price, SUM(quantity) AS total_sold_quantity FROM sold_items";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Fetch data from tables
$medicineStockData = fetchMedicineStockData($conn);
$soldItemsData = fetchSoldItemsData($conn);

?>

 
    <style>
        article {
            
            text-align: center;
        }
        .card {
            margin-bottom: 0px;
        }
        .card-header {
           
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <!-- Medicine Stock Data -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Medicine Stock</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Total Items: <?php echo $medicineStockData['total_items']; ?></li>
                            <li class="list-group-item">Total Price: $<?php echo $medicineStockData['total_price']; ?></li>
                            <li class="list-group-item">Total Quantity: <?php echo $medicineStockData['total_quantity']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sold Items Data -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Sold Items</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Total Sold Items: <?php echo $soldItemsData['total_sold_items']; ?></li>
                            <li class="list-group-item">Total Sold Price: $<?php echo $soldItemsData['total_sold_price']; ?></li>
                            <li class="list-group-item">Total Sold Quantity: <?php echo $soldItemsData['total_sold_quantity']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 

<?php
// Function to count out of stock items based on interval
function countOutOfStock($conn, $interval) {
    $sql = "SELECT COUNT(*) AS count FROM out_of_stock WHERE DATE(date_added) $interval";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['count'];
}

// Function to calculate sum of sold items
function sumSoldItems($conn, $interval) {
    $sql = "SELECT SUM(quantity) AS total_sold FROM sold_items WHERE DATE(sale_date) $interval";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['total_sold'];
}

// Function to calculate sum of sold quantity
function sumSoldQuantity($conn, $interval) {
    $sql = "SELECT SUM(total) AS total_quantity FROM sold_items WHERE DATE(sale_date) $interval";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['total_quantity'];
}
?>

<article>
    <div class="container mt-1">
        <div class="card">
            <h3 class="card-header">Sales Analytics</h3>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered border-secondary table-hover">
                        <thead>
                            <tr>
                                <th>Interval</th>
                                <th>Out of Stock</th>
                                <th>Sold Items</th>
                                <th>Sold Quantity</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Yesterday</td>
                                <td><?php echo countOutOfStock($conn, "= CURDATE() - INTERVAL 1 DAY"); ?></td>
                                <td><?php echo sumSoldItems($conn, "= CURDATE() - INTERVAL 1 DAY"); ?></td>
                                <td><?php echo sumSoldQuantity($conn, "= CURDATE() - INTERVAL 1 DAY"); ?></td>
                                <td rowspan="4" class="align-middle"><h1 id="grandTotalCell"></h1></td>
                            </tr>
                            <tr>
                                <td>Current Date</td>
                                <td><?php echo countOutOfStock($conn, "= CURDATE()"); ?></td>
                                <td><?php echo sumSoldItems($conn, "= CURDATE()"); ?></td>
                                <td><?php echo sumSoldQuantity($conn, "= CURDATE()"); ?></td>
                            </tr>
                            <tr>
                                <td>Current Month</td>
                                <td><?php echo countOutOfStock($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())"); ?></td>
                                <td><?php echo sumSoldItems($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())"); ?></td>
                                <td><?php echo sumSoldQuantity($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())"); ?></td>
                            </tr>
                            <tr>
                                <td>Current Year</td>
                                <td><?php echo countOutOfStock($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND DATE_FORMAT(NOW(), '%Y-12-31')"); ?></td>
                                <td><?php echo sumSoldItems($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND DATE_FORMAT(NOW(), '%Y-12-31')"); ?></td>
                                <td><?php echo sumSoldQuantity($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND DATE_FORMAT(NOW(), '%Y-12-31')"); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                    // Calculate and display grand total
                    $grandTotal = 0;
                    $grandTotal += sumSoldQuantity($conn, "= CURDATE() - INTERVAL 1 DAY");
                    $grandTotal += sumSoldQuantity($conn, "= CURDATE()");
                    $grandTotal += sumSoldQuantity($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())");
                    $grandTotal += sumSoldQuantity($conn, "BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND DATE_FORMAT(NOW(), '%Y-12-31')");
                    ?>

                    <script>
                        // Display grand total dynamically
                        document.getElementById('grandTotalCell').innerText = '<?php echo $grandTotal; ?>';
                    </script>

                    <?php
                    // Close connection
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
