<?php include("connection.php"); ?>
<?php
header('Content-Type: application/json');
// Fetch medicine data
$sql = "SELECT * FROM medicine_stock";
$result = $conn->query($sql);

$medicines = array();
while ($row = $result->fetch_assoc()) {
    $medicines[] = $row;
}

// Output JSON
echo json_encode($medicines);

$conn->close();
?>
