<?php include("connection.php"); ?>
<?php
// delete_out_of_stock.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['items'])) {
    $items = $_POST['items'];

    foreach ($items as $itemId) {
        $sql = "DELETE FROM out_of_stock WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
    }

    $conn->close();
    echo count($items) . " item(s) deleted successfully.";
} else {
    echo "Invalid request.";
}
?>
