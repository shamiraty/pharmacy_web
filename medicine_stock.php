<?php include("connection.php"); ?>
<?php
// fetch_medicines.php
$sql = "SELECT * FROM medicine_stock";
$result = $conn->query($sql);

$medicines = array();
while ($row = $result->fetch_assoc()) {
    $medicines[] = $row;
}

echo json_encode($medicines);

$conn->close();
?>
