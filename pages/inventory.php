<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addInventoryModal">Add New Inventory</button>

<!-- Modal for Adding Inventory -->
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Custom Batch Name</th>
                                    <th>MRP</th>
                                    <th>Discount (%)</th>
                                    <th>Selling Price</th>
                                    <th>Stock Quantity</th>
                                    <th>Packaging(gm/kg) </th>
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
                                    <td><input type="text" class="form-control" name="productName" required readonly></td>
                                    <td><input type="text" class="form-control" name="customBatchName"></td>
                                    <td><input type="number" class="form-control" name="mrp" required oninput="calculateSellingPrice(this)"></td>
                                    <td><input type="number" class="form-control" name="discount" required oninput="calculateSellingPrice(this)"></td>
                                    <td><input type="number" class="form-control" name="sellingPrice" readonly></td>
                                    <td><input type="number" class="form-control" name="stockQuantity" required></td>
                                    <td>
                                        <input type="text" class="form-control" name="packaging">
                                        <select class="form-select" name="packagingUnit" required>
                                            <option value="">Select Unit</option>
                                            <option value="gm">Gram (gm)</option>
                                            <option value="kg">Kilogram (kg)</option>
                                        </select>
                                    </td>
                                    <td><input type="date" class="form-control" name="manufacturingDate" required></td>
                                    <td><input type="date" class="form-control" name="expirationDate" required></td>
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
document.addEventListener('DOMContentLoaded', function() {
    loadProducts(); // Load products to populate the product ID dropdown

    // Calculate selling price based on MRP and discount
    window.calculateSellingPrice = function(input) {
        const row = input.closest('tr');
        const mrp = parseFloat(row.querySelector('input[name="mrp"]').value) || 0;
        const discount = parseFloat(row.querySelector('input[name="discount"]').value) || 0;
        const sellingPrice = mrp - (mrp * (discount / 100));
        row.querySelector('input[name="sellingPrice"]').value = Math.round(sellingPrice * 100) / 100; // Round off to 2 decimal places
    }

    // Save inventory
    document.getElementById('saveInventory').addEventListener('click', function() {
        const inventoryData = new FormData(document.getElementById('inventoryForm'));

        fetch('config/save_inventory.php', {
            method: 'POST',
            body: inventoryData
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

    // Add new item row functionality
    document.getElementById('addNewItem').addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select class="form-select" name="productId" required>
                    <!-- Options will be populated from the database -->
                </select>
            </td>
            <td><input type="text" class="form-control" name="productName" required readonly></td>
            <td><input type="text" class="form-control" name="customBatchName"></td>
            <td><input type="number" class="form-control" name="mrp" required oninput="calculateSellingPrice(this)"></td>
            <td><input type="number" class="form-control" name="discount" required oninput="calculateSellingPrice(this)"></td>
            <td><input type="number" class="form-control" name="sellingPrice" readonly></td>
            <td><input type="number" class="form-control" name="stockQuantity" required></td>
            <td><input type="text" class="form-control" name="packaging">
                <select class="form-select" name="packagingUnit" required>
                    <option value="">Select Unit</option>
                    <option value="gm">Gram (gm)</option>
                    <option value="kg">Kilogram (kg)</option>
                </select>
            </td>
            <td><input type="date" class="form-control" name="manufacturingDate" required></td>
            <td><input type="date" class="form-control" name="expirationDate" required></td>
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
                data.products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.product_id;
                    option.textContent = product.product_id; // Display product name
                    select.appendChild(option);
                });
                // Add event listener to update product name when product ID changes
                select.addEventListener('change', function() {
                    const selectedProduct = data.products.find(p => p.product_id == this.value);
                    if (selectedProduct) {
                        const productNameInput = select.closest('tr').querySelector('input[name="productName"]');
                        productNameInput.value = selectedProduct.product_name; // Set product name
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
</script>
