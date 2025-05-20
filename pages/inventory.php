<?php
include 'config/db_con.php'; ?>



<button class="btn btn-success mb-3 float-right text-right" data-bs-toggle="modal" data-bs-target="#addInventoryModal">Add New Inventory</button>

<!-- showing the dta -->
<div class="table-responsive">
    <table class="table table-striped table-bordered">

        <thead>
            <tr>

                <th>Product Name</th>
                <th>Custom Batch Name</th>
                <th>MRP</th>
                <th>Discount (%)</th>
                <th>Selling Price</th>
                <th>Stock Quantity</th>
                <th>Unit (gm/kg)</th>
                <th>Manufacturing Date</th>
                <th>Expiration Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="showingInventory">

            <?php

            // Fetch inventory items from the database
            $result = $conn->query("SELECT product_id, product_name, custom_batch_name, mrp, discount, selling_price, stock_quantity, packagingwithunit, manufacturing_date, expiration_date FROM inventory");

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['product_name']}</td>
                        <td>{$row['custom_batch_name']}</td>
                        <td>{$row['mrp']}</td>
                        <td>{$row['discount']}</td>
                        <td>{$row['selling_price']}</td>
                        <td>{$row['stock_quantity']}</td>
                        <td>{$row['packagingwithunit']}</td>
                        <td>{$row['manufacturing_date']}</td>
                        <td>{$row['expiration_date']}</td>
                        <td>
                            <button class='btn btn-sm btn-info'>
                                <i class='fas fa-eye'></i>
                            </button>
                            <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-product-id='{$row['product_id']}' data-product-name='{$row['product_name']}'>
                                <i class='fas fa-trash'></i>
                            </button>
                           
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='text-center'>No inventory items found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
            <!-- Inventory items will be dynamically inserted here -->
        </tbody>
    </table>
</div>


<!-- Modal for Confirming Deletion -->
<div class='modal fade' id='confirmDeleteModal' tabindex='-1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirm Deletion</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Are you sure you want to delete <strong id='productName'></strong> (ID: <span id='productId'></span>)?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                <button type='button' class='btn btn-danger' id='confirmDeleteButton'>Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // jQuery to handle the modal and delete action
    $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productId = button.data('product-id'); // Extract info from data-* attributes
        var productName = button.data('product-name');
        var modal = $(this);
        modal.find('#productName').text(productName);
        modal.find('#productId').text(productId);
        modal.find('#confirmDeleteButton').off('click').on('click', function() {
            if (!productId) {
                alert('Product ID is missing. Cannot proceed with deletion.');
                return;
            }
            $.ajax({
                url: 'config/delete_inventory.php', // URL to your delete script
                type: 'POST',
                data: {
                    id: productId,
                    name: productName
                },
                success: function(response) {
                    // Display server response message
                    alert(response.message);
                    // Hide the modal
                    $('#confirmDeleteModal').modal('hide');
                    // Reload the page to see changes
                    // location.reload();
                },
                error: function() {
                    // Handle error response
                    alert('Error deleting the product.');
                }
            });
        });
    });
</script>














<!-- Modal for Adding new Inventory -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInventoryModalLabel">Add New Inventory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inventoryForm">
                    <div class="table-responsive">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="inventoryNumber" class="form-label">Inventory Number</label>
                                <input type="text" class="form-control" id="inventoryNumber" name="inventoryNumber" readonly value="INV123456">
                            </div>
                            <div class="col-md-3">
                                <label for="inventoryDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="inventoryDate" name="inventoryDate" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label for="partyName" class="form-label">Party Name</label>
                                <select class="form-select" id="partyName" name="partyName" required>
                                    <option value="">Select Party</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="billingNumber" class="form-label">Billing Number</label>
                                <input type="text" class="form-control" id="billingNumber" name="billingNumber" required>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <!-- <th>Product ID</th> -->
                                    <th>Custom Batch Name</th>
                                    <th>MRP</th>
                                    <th>Discount (%)</th>
                                    <th>Selling Price</th>
                                    <th>Stock Quantity</th>
                                    <th>Unit(gm/kg) </th>
                                    <th>Manufacturing Date</th>
                                    <th>Expiration Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryTableBody">
                                <tr>
                                    <td>
                                        <select class="form-select" name="productId" required>
                                            <!-- Options will be populated from the database -->
                                        </select>
                                    </td>
                                    <!-- <td><input type="text" class="form-control" name="productName" id="productName" required readonly></td> -->
                                    <td><input type="text" class="form-control" name="customBatchName" id="customBatchName"></td>
                                    <td><input type="number" class="form-control" name="mrp" id="mrp" required oninput="calculateSellingPrice(this)"></td>
                                    <td><input type="number" class="form-control" name="discount" id="discount" required oninput="calculateSellingPrice(this)"></td>
                                    <td><input type="number" class="form-control" name="sellingPrice" id="sellingPrice" readonly></td>
                                    <td><input type="number" class="form-control" name="stockQuantity" id="stockQuantity" required></td>
                                    <td>
                                        <input type="text" class="form-control" name="packaging" id="packaging">
                                        <select class="form-select" name="packagingUnit" id="packagingUnit" class="packagingUnit" required>
                                            <option value="">Select Unit</option>
                                        </select>

                                    </td>


                                    <td><input type="date" class="form-control" name="manufacturingDate" id="manufacturingDate" required></td>
                                    <td><input type="date" class="form-control" name="expirationDate" id="expirationDate" required></td>



                                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary" id="addNewItem">Add New Item</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveInventory">Save Inventory</button>
            </div>
        </div>
    </div>
</div>

<script>
    // make here the party name with searchable 
    document.addEventListener('DOMContentLoaded', function() {
        fetch('config/get-party-names.php')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('partyName');
                data.forEach(party => {
                    const option = document.createElement('option');
                    option.value = party.party_name;
                    option.textContent = party.party_name;
                    select.appendChild(option);
                });

                // Activate select2 on the dropdown
                $('#partyName').select2({
                    placeholder: "Select Party",
                    allowClear: true
                });
            })
            .catch(error => console.error('Error fetching party names:', error));
    });



    document.addEventListener('DOMContentLoaded', function() {
        loadProducts();
        validateDates();

        document.getElementById('stockQuantity').addEventListener('change', function() {
            const stockQuantity = this.value;

            if (stockQuantity < 0) {
                alert('Stock quantity cannot be negative.');
                this.value = 0; // Reset to 0
            }
        });

        // Calculate selling price based on MRP and discount
        window.calculateSellingPrice = function(input) {
            const row = input.closest('tr');
            const mrp = parseFloat(row.querySelector('input[name="mrp"]').value) || 0;
            const discount = parseFloat(row.querySelector('input[name="discount"]').value) || 0;

            // Validate MRP and discount
            if (mrp < 0) {
                alert("MRP cannot be negative.");
                row.querySelector('input[name="mrp"]').value = 0; // Reset MRP to 0
                return;
            }
            if (discount < 0 || discount > 100) {
                alert("Discount must be between 0% and 100%.");
                row.querySelector('input[name="discount"]').value = 0; // Reset discount to 0
                return;
            }

            const sellingPrice = mrp - (mrp * (discount / 100));
            row.querySelector('input[name="sellingPrice"]').value = Math.round(sellingPrice * 100) / 100; // Round off to 2 decimal places
        }



        // Save inventory
        document.getElementById('saveInventory').addEventListener('click', function() {
            const inventoryRows = document.querySelectorAll('#inventoryTableBody tr');
            const inventoryData = [];
            const inventoryNumber = document.getElementById('inventoryNumber').value;
            const inventoryDate = document.getElementById('inventoryDate').value;
            const partyName = document.getElementById('partyName').value;
            const billingNumber = document.getElementById('billingNumber').value;


            inventoryRows.forEach(row => {
                const productId = row.querySelector('select[name="productId"]').value;
                const productName = row.querySelector('input[name="productName"]').value;
                const customBatchName = row.querySelector('input[name="customBatchName"]').value;
                const mrp = row.querySelector('input[name="mrp"]').value;
                const discount = row.querySelector('input[name="discount"]').value;
                const sellingPrice = row.querySelector('input[name="sellingPrice"]').value;
                const stockQuantity = row.querySelector('input[name="stockQuantity"]').value;
                const packaging = row.querySelector('input[name="packaging"]').value;
                const packagingUnit = row.querySelector('select[name="packagingUnit"]').value;
                const manufacturingDate = row.querySelector('input[name="manufacturingDate"]').value;
                const expirationDate = row.querySelector('input[name="expirationDate"]').value;
                const packagingwithunit = packaging + " " + packagingUnit;
                // Log the data for debugging
                console.log("Hello", {
                    inventoryNumber,
                    productId,
                    productName,
                    customBatchName,
                    mrp,
                    discount,
                    sellingPrice,
                    stockQuantity,
                    packagingwithunit,
                    manufacturingDate,
                    expirationDate,
                    inventoryNumber,
                    inventoryDate,
                    partyName,
                    billingNumber
                });

                inventoryData.push({
                    inventoryNumber,
                    inventoryDate,
                    partyName,
                    billingNumber,
                    productId,
                    productName,
                    customBatchName,
                    mrp,
                    discount,
                    sellingPrice,
                    stockQuantity,
                    packagingwithunit,
                    manufacturingDate,
                    expirationDate
                });
            });

            // Send the collected data to the server
            fetch('config/save_inventory.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(inventoryData)
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadInventory(); // Reload inventory after adding a new one
                    document.getElementById('inventoryForm').reset();
                    $('#addInventoryModal').modal('hide');
                })
                .catch(() => {
                    alert('Error adding inventory.');
                });
        });

        // <td><input type="text" class="form-control" name="productName" id="productName"  required readonly></td>
        // Add new item row functionality
        document.getElementById('addNewItem').addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>
                <select class="form-select" name="productId" required>
                    <!-- Options will be populated from the database -->
                </select>
            </td>
            <td><input type="text" class="form-control" name="customBatchName" id="customBatchName"></td>
            <td><input type="number" class="form-control" name="mrp" id="mrp"  required oninput="calculateSellingPrice(this)"></td>
            <td><input type="number" class="form-control" name="discount" id="discount" required oninput="calculateSellingPrice(this)"></td>
            <td><input type="number" class="form-control" name="sellingPrice" id="sellingPrice" readonly></td>
            <td><input type="number" class="form-control" name="stockQuantity" id="stockQuantity" required></td>
             <td>
                                        <input type="text" class="form-control" name="packaging" id="packaging">
                                        <select class="form-select" name="packagingUnit" id="packagingUnit" class="packagingUnit" required>
                                            <option value="">Select Unit</option>
                                        </select>

                                    </td>
            <td><input type="date" class="form-control" name="manufacturingDate" id="manufacturingDate" required></td>
            <td><input type="date" class="form-control" name="expirationDate" id="expirationDate" required></td>
            <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
        `;




            document.getElementById('inventoryTableBody').appendChild(newRow);
            loadProducts(); // Load products for the new row
        });

        // Remove row functionality
        document.getElementById('inventoryTableBody').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    });

    // Load products to populate the product ID dropdown
    function loadProducts() {
        fetch('config/get_products.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const productSelects = document.querySelectorAll('select[name="productId"]');

                productSelects.forEach(select => {
                    // Populate options by product_name
                    data.products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.product_name; // Use product_name as value
                        option.textContent = product.product_name;
                        select.appendChild(option);
                    });

                    // Handle change event using product_name
                    select.addEventListener('change', function() {
                        const selectedProduct = data.products.find(p => p.product_name === this.value);

                        console.log(selectedProduct);
                        if (selectedProduct) {
                            const productNameInput = select.closest('tr').querySelector('input[name="productName"]');
                            productNameInput.value = selectedProduct.product_name;
                        }
                    });
                });

            })
            .catch(error => {
                console.error('Error loading products:', error);
                alert('Failed to load products. Please check the server.');
            });
    }

    // Load inventory to display in a table
    function loadInventory() {
        fetch('config/get_inventory.php')
            .then(response => response.json())
            .then(data => {
                // Populate the inventory table
                // Implement the logic to display inventory data
            })
            .catch(error => {
                console.error('Error loading inventory:', error);
            });
    }

    // Validate manufacturing and expiration dates
    function validateDates() {
        const manufacturingDateInput = document.getElementById('manufacturingDate');
        const expirationDateInput = document.getElementById('expirationDate');

        manufacturingDateInput.addEventListener('change', function() {
            const manufacturingDate = new Date(this.value);
            const expirationDate = new Date(expirationDateInput.value);

            if (manufacturingDate > expirationDate) {
                alert('Manufacturing date cannot be greater than expiration date.');
                this.value = '';
            }
        });

        expirationDateInput.addEventListener('change', function() {
            const manufacturingDate = new Date(manufacturingDateInput.value);
            const expirationDate = new Date(this.value);

            if (manufacturingDate > expirationDate) {
                alert('Manufacturing date cannot be greater than expiration date.');
                this.value = '';
            }
        });
    }
</script>
<!-- // fetch the unit fomr the table  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('config/get-units.php')
            .then(response => response.json())
            .then(data => {
                const unitSelect = document.getElementById('packagingUnit');
                data.forEach(unit => {
                    const option = document.createElement('option');
                    option.value = unit.unit;
                    option.textContent = unit.unit;
                    unitSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching units:', error));
    });
</script>