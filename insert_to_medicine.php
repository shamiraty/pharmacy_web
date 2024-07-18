<?php include("connection.php"); ?>
<?php
// Retrieve form data
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$expiry_date = $_POST['expiry_date'];

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO medicine_stock (name, price, expiry_date,quantity) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $name, $price, $expiry_date, $quantity);

// Execute SQL statement
if ($stmt->execute()) {
    // Return success response
    echo json_encode(['status' => 'success']);
} else {
    // Return error response
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
