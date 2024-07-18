<?php include("connection.php"); ?>
<?php include("nav.php")  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Out of Stock Items</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-primary">Out of Stock Items</h3>
        <div class="card mt-1">
                    <h3 class="card-header bg-primary text-white"></h3>
                    <div class="card-body">
                        <div class="table-responsive">
        <table id="outOfStockTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Expiry Date</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch out of stock items
                $sql = "SELECT id, name, price, expiry_date, quantity FROM out_of_stock";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['expiry_date'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo '<td><input type="checkbox" class="item-checkbox bg-danger" value="' . $row['id'] . '"></td>';
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="6">No items found</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    
        <button id="deleteSelected" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Delete Selected</button>
    </div>
    </div>
    </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the selected items?</p>
                    <ul class="list-group"id="selectedItemsList"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var selectedItems = [];

            // Checkbox change event
            $('.item-checkbox').change(function() {
                var itemId = $(this).val();
                if ($(this).is(':checked')) {
                    selectedItems.push(itemId);
                } else {
                    var index = selectedItems.indexOf(itemId);
                    if (index !== -1) {
                        selectedItems.splice(index, 1);
                    }
                }
            });

            // Delete selected items
            $('#confirmDeleteBtn').click(function() {
                $.ajax({
                    url: 'delete_out_of_stock.php',
                    method: 'POST',
                    data: { items: selectedItems },
                    success: function(response) {
                        alert(response);
                        // Reload the table after deletion
                        location.reload();
                    }
                });
            });

            // Show selected items in modal
            $('#deleteSelected').click(function() {
                $('#selectedItemsList').empty();
                selectedItems.forEach(function(itemId) {
                    var itemName = $('#outOfStockTable').find('input[value="' + itemId + '"]').closest('tr').find('td:eq(1)').text();
                    $('#selectedItemsList').append('<li class="list-group-item text-danger"><i class="fas fa-prescription-bottle-alt text-danger"></i>'  +  itemName  +  '</li>');
                });
            });
        });
    </script>
</body>
</html>
