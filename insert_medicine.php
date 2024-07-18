<?php include("nav.php")  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Medicine</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- SweetAlert2 for nice dialogs -->
    <style>
        .centered-form {
            display: flex;
            justify-content: center;
            align-items: center;
             
        }
        .card {
            width: 600px; /* Set card width */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
             
            color: #fff; /* Header text color */
        }
        
    </style>
</head>
<body>
<div class="container">
    <div class="centered-form mt-2">
        <div class="card">
            <div class="card-header text-center">
                <img src="images/company_logo.png" alt="Logo"class="w-50">
                 
            </div>
            <div class="card-body">
                <form id="medicineForm">
                    <div class="form-group">
                        <label for="name">Medicine Name:</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter medicine name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" class="form-control" placeholder="Enter price" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" class="form-control" placeholder="quantity" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date:</label>
                        <input type="date" id="expiry_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Insert Medicine</button>
                </form>
            </div>
           
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#medicineForm').submit(function(event) {
                event.preventDefault();

                // Show loading dialog
                $('#medicineForm .btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);

                // Get form data
                var formData = {
                    name: $('#name').val(),
                    price: $('#price').val(),                   
                    quantity: $('#quantity').val(),
                    expiry_date: $('#expiry_date').val()
                };

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'insert_to_medicine.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Reset form and show success message
                        $('#medicineForm')[0].reset();
                        $('#medicineForm .btn').html('Insert Medicine').prop('disabled', false);
                         
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Medicine added successfully!',
                        });
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        $('#medicineForm .btn').html('Insert Medicine').prop('disabled', false);
                        alert('Error: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
