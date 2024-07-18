<?php include("nav.php")  ?>
<body>
    <div class="container-fluid mt-1">
        <div class="row">

    
        <div class="col-md-3">
        <div class="card mt-1">
        <h3 class="card-header bg-warning text-white"></h3>
        <div class="card-body">
                <h2 class="text-primary">Add Medicines</h2>
                <form id="medicineForm">
                    <div class="form-group">
                        <label for="medicineSearch">Search for a medicine in the box below, then click on the table data to select the item you searched for.</label>
                        <input type="text" id="medicineSearch" class="form-control">
                    </div>
                    <div id="selectedMedicines"></div>
                    <h3 class="text-warning"><strong>Total: <span id="grandTotal">0</strong></span></h3>
                    <button type="button" id="saleButton" class="btn btn-primary btn-sm w-25">Sale</button>
                </form>
            </div>
            </div>
            </div>




            <div class="col-md-9">
                <div class="card mt-1">
                    <h3 class="card-header bg-primary text-white"></h3>
                    <div class="card-body">
                        <div class="table-responsive">
                <table id="medicineTable" class="table table-striped  table-bordered table-hover  ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Expiry Date</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            </div>
            </div>
            </div>
         
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch and display medicines
            $.ajax({
                url: 'fetch_medicines.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    let table = $('#medicineTable').DataTable();
                    table.clear().draw();
                    data.forEach(medicine => {
                        table.row.add([
                            medicine.id,
                            medicine.name,
                            medicine.price,
                            medicine.expiry_date,
                            medicine.quantity
                        ]).draw();
                    });
                }
            });

            let selectedMedicines = {};
            let grandTotal = 0;

            $('#medicineSearch').on('input', function() {
                let query = $(this).val().toLowerCase();
                $('#medicineTable tbody tr').each(function() {
                    let name = $(this).find('td:eq(1)').text().toLowerCase();
                    if (name.includes(query)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#medicineTable tbody').on('click', 'tr', function() {
                let id = $(this).find('td:eq(0)').text();
                let name = $(this).find('td:eq(1)').text();
                let price = parseFloat($(this).find('td:eq(2)').text());
                let quantity = parseInt($(this).find('td:eq(4)').text());

                if (!selectedMedicines[id]) {
                    selectedMedicines[id] = { name, price, quantity, selectedQuantity: 1, total: price };
                } else {
                    selectedMedicines[id].selectedQuantity++;
                    selectedMedicines[id].total += price;
                }

                updateSelectedMedicines();
            });

            function updateSelectedMedicines() {
                $('#selectedMedicines').empty();
                grandTotal = 0;

                for (let id in selectedMedicines) {
                    let medicine = selectedMedicines[id];
                    grandTotal += medicine.total;

                    $('#selectedMedicines').append(`
                        <div class="form-group">
                            <label>${medicine.name} (${medicine.price} per unit):</label>
                            <input type="number" class="form-control medicine-quantity" data-id="${id}" value="${medicine.selectedQuantity}" min="1" max="${medicine.quantity}">
                            <button type="button" class="btn btn-danger btn-sm w-25 remove-medicine mt-1" data-id="${id}">&times;</button>
                            <p>Total: ${medicine.total.toFixed(2)}</p>
                        </div>
                    `);
                }

                $('#grandTotal').text(grandTotal.toFixed(2));
            }

            $('#selectedMedicines').on('change', '.medicine-quantity', function() {
                let id = $(this).data('id');
                let newQuantity = parseInt($(this).val());
                let price = selectedMedicines[id].price;

                selectedMedicines[id].selectedQuantity = newQuantity;
                selectedMedicines[id].total = newQuantity * price;

                updateSelectedMedicines();
            });

            $('#selectedMedicines').on('click', '.remove-medicine', function() {
                let id = $(this).data('id');
                delete selectedMedicines[id];
                updateSelectedMedicines();
            });

            $('#saleButton').on('click', function() {
                $.ajax({
                    url: 'process_sale.php',
                    method: 'POST',
                    data: { medicines: JSON.stringify(selectedMedicines) },
                    success: function(response) {
                        if (response.includes("Error")) {
                            swal("Error", response, "error");
                        } else {
                            swal("Success", response, "success").then(() => {
                                window.location.href = 'print_receipt.php';
                            });
                        }
                    },
                    error: function() {
                        swal("Error", "An error occurred while processing the sale.", "error");
                    }
                });
            });
        });
    </script>
</body>
</html>
