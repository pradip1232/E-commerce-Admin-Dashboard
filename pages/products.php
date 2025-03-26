<?php
include 'config/db_con.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Products</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by Product Name..." style="width: 200px;" onkeyup="liveSearch()">
                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable" id="productTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Existing product rows will be populated here -->
                                <?php
                                // Fetch products from the database
                                $sql = "SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . (isset($row['product_id']) ? $row['product_id'] : 'NA') . "</td>";
                                        echo "<td>". (isset($row["images"]) ? "<img src='" . $row["images"] . "' alt='Product Image' style='width:50px;'>" : 'NA') . "</td>";
                                        echo "<td>" . (isset($row['product_name']) ? $row['product_name'] : 'NA') . "</td>";
                                        echo "<td>" . (isset($row['product_category']) ? $row['product_category'] : 'NA') . "</td>";
                                        echo "<td>" . (isset($row['product_price']) ? $row['product_price'] : 'NA') . "</td>";
                                        echo "<td>" . (isset($row['product_stock']) ? $row['product_stock'] : 'NA') . "</td>";
                                        echo "<td>" . (isset($row['product_status']) ? $row['product_status'] : 'NA') . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit_product.php?id=" . $row['product_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                                        echo "<a href='delete_product.php?id=" . $row['product_id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center'>No products found in your database.</td></tr>";
                                }
                                ?>  
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center" id="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script>
        const searchInput = document.getElementById('searchInput');
        const productTable = document.getElementById('productTable');
        const pagination = document.getElementById('pagination');
        const rowsPerPage = 8;
        let currentPage = 1;

        function displayTable(page) {
            const rows = productTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            for (let i = 0; i < totalRows; i++) {
                rows[i].style.display = (i >= start && i < end) ? '' : 'none';
            }

            pagination.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = 'page-item' + (i === page ? ' active' : '');
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    displayTable(currentPage);
                });
                pagination.appendChild(li);
            }
        }

        // searchInput.addEventListener('keyup', () => {
        //     const filter = searchInput.value.toLowerCase();
        //     const rows = productTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        //     for (let row of rows) {
        //         const cells = row.getElementsByTagName('td');
        //         let found = false;
        //         for (let cell of cells) {
        //             if (cell.textContent.toLowerCase().includes(filter)) {
        //                 found = true;
        //                 break;
        //             }
        //         }
        //         row.style.display = found ? '' : 'none';
        //     }
        //     displayTable(1); // Reset to first page
        // });

        displayTable(currentPage); // Initial display
    </script>
     <script>
                        function liveSearch() {
                            const input = document.getElementById('searchInput').value.toLowerCase();
                            const rows = document.querySelectorAll('#productTable tbody tr');
                            rows.forEach(row => {
                                const productName = row.cells[2].textContent.toLowerCase(); // Assuming product name is in the 3rd column
                                row.style.display = productName.includes(input) ? '' : 'none';
                            });
                        }
                    </script>
</div>




<!-- Full Screen Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 95%; margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product SKU</th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>HSN Number</th>
                                    <th>Tax Rate</th>
                                    <th>Key Benefits</th>
                                    <th>Description</th>
                                    <th>Product Benefits</th>
                                    <th>Product Usage</th>
                                    <th>Images</th>
                                    <th>Videos</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="productRows">
                                <tr>
                                    <td><input type="text" class="form-control" id="productId" name="productId" readonly></td>
                                    <td><input type="text" class="form-control" id="productSku" name="productSku" readonly></td>
                                    <td><input type="text" class="form-control" id="productName" name="productName" required></td>
                                    <td>
                                        <select class="form-select" id="productCategory" name="productCategory" required>
                                            <option value="">Select Category</option>
                                            <option value="electronics">Electronics</option>
                                            <option value="clothing">Clothing</option>
                                            <option value="books">Books</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="hsnNumber" required></td>
                                    <td>
                                        <select class="form-select" id="taxRate" required>
                                            <option value="">Select Tax Rate</option>
                                            <option value="0">0%</option>
                                            <option value="5">5%</option>
                                            <option value="12">12%</option>
                                            <option value="18">18%</option>
                                            <option value="28">28%</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" id="keyBenefits" name="keyBenefits" rows="1" required></textarea></td>
                                    <td><textarea class="form-control" id="description" name="description"  rows="1" required></textarea></td>
                                    <td><textarea class="form-control" id="productBenefits" rows="1" name="productBenefits" required></textarea></td>
                                    <td><textarea class="form-control" id="productUsage" rows="1" name="productUsage" required></textarea></td>
                                    <td>
                                        <input type="file" class="form-control" id="productImages" name="productImages" multiple accept="image/*">
                                        <small class="text-muted">Upload images</small>
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" id="productVideos" name="productVideos" multiple accept="video/*">
                                        <small class="text-muted">Upload videos</small>
                                    </td>
                                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" id="addRow">Add New Item</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveProduct">Save Product</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("Document loaded. Setting up event listeners.");

    // Generate unique Product ID (16 digits)
    function generateProductId() {
        return 'PRD' + Date.now().toString().slice(-13);
    }
    
    // Generate SKU (14 digits)
    function generateSku() {
        return 'SKU' + Math.random().toString().slice(2, 15);
    }
    
    // Set auto-generated values when modal opens
    const addProductModal = document.getElementById('addProductModal');
    addProductModal.addEventListener('show.bs.modal', function() {
        console.log("Add Product Modal opened.");
        const productId = generateProductId();
        const productSku = generateSku();
        const newRow = `
            <tr>
                <td><input type="text" class="form-control" value="${productId}" id="productId" name="productId" readonly></td>
                <td><input type="text" class="form-control" value="${productSku}" id="productSku" name="productSku" readonly></td>
                <td><input type="text" class="form-control" id="productName" name="productName" required></td>
                <td>
                    <select class="form-select" id="productCategory" name="productCategory" required>
                        <option value="">Select Category</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="books">Books</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" id="hsnNumber" name="hsnNumber" required></td>
                <td>
                    <select class="form-select" id="taxRate" name="taxRate" required>
                        <option value="">Select Tax Rate</option>
                        <option value="0">0%</option>
                        <option value="5">5%</option>
                        <option value="12">12%</option>
                        <option value="18">18%</option>
                        <option value="28">28%</option>
                    </select>
                </td>
                <td><textarea class="form-control" id="keyBenefits" name="keyBenefits" rows="1" required></textarea></td>
                <td><textarea class="form-control" id="description" name="description" rows="1" required></textarea></td>
                <td><textarea class="form-control" id="productBenefits" name="productBenefits" rows="1" required></textarea></td>
                <td><textarea class="form-control" id="productUsage" name="productUsage" rows="1" required></textarea></td>
                <td>
                    <input type="file" class="form-control" id="productImages" name="productImages" multiple accept="image/*">
                    <small class="text-muted">Upload images</small>
                </td>
                <td>
                    <input type="file" class="form-control" id="productVideos" name="productVideos" multiple accept="video/*">
                    <small class="text-muted">Upload videos</small>
                </td>
                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
            </tr>
        `;
        document.getElementById('productRows').innerHTML = newRow; // Clear previous rows and add new row
    });
    
    // Add new row functionality
    document.getElementById('addRow').addEventListener('click', function() {
        console.log("Adding new row.");
        const productId = generateProductId();
        const productSku = generateSku();
        const newRow = `
            <tr>
                <td><input type="text" class="form-control" value="${productId}" name="productId" id="productId" readonly></td>
                <td><input type="text" class="form-control" value="${productSku}" name="productSku" id="productSku" readonly></td>
                <td><input type="text" class="form-control" name="productName" id="productName" required></td>
                <td>
                    <select class="form-select" name="productCategory" id="productCategory" required>
                        <option value="">Select Category</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="books">Books</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="hsnNumber" id="hsnNumber" required></td>
                <td>
                    <select class="form-select" name="taxRate" id="taxRate" required>
                        <option value="">Select Tax Rate</option>
                        <option value="0">0%</option>
                        <option value="5">5%</option>
                        <option value="12">12%</option>
                        <option value="18">18%</option>
                        <option value="28">28%</option>
                    </select>
                </td>
                <td><textarea class="form-control" name="keyBenefits" id="keyBenefits" rows="1" required></textarea></td>
                <td><textarea class="form-control" name="description" id="description" rows="1" required></textarea></td>
                <td><textarea class="form-control" name="productBenefits" id="productBenefits" rows="1" required></textarea></td>
                <td><textarea class="form-control" name="productUsage" id="productUsage" rows="1" required></textarea></td>
                <td>
                    <input type="file" class="form-control" name="productImages" id="productImages" multiple accept="image/*">
                    <small class="text-muted">Upload images</small>
                </td>
                <td>
                    <input type="file" class="form-control" name="productVideos" id="productVideos" multiple accept="video/*">
                    <small class="text-muted">Upload videos</small>
                </td>
                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
            </tr>
        `;
        document.getElementById('productRows').insertAdjacentHTML('beforeend', newRow);
    });

    // Remove row functionality
    document.getElementById('productRows').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            console.log("Removing row.");
            e.target.closest('tr').remove();
        }
    });

    // Save product functionality
    document.getElementById('saveProduct').addEventListener('click', function() {
        console.log("Save Product button clicked.");
        const rows = document.querySelectorAll('#productRows tr');
        const products = [];
        console.log(`Found ${rows.length} rows in the product table.`);

        rows.forEach((row, index) => {
            console.log(`Processing row ${index + 1}.`);
            
            const product_id = row.querySelector('input[name="productId"]');
            const product_sku = row.querySelector('input[name="productSku"]');
            const product_name = row.querySelector('input[name="productName"]');
            const product_category = row.querySelector('select[name="productCategory"]');
            const hsn_number = row.querySelector('input[name="hsnNumber"]');
            const tax_rate = row.querySelector('select[name="taxRate"]');
            const key_benefits = row.querySelector('textarea[name="keyBenefits"]');
            const description = row.querySelector('textarea[name="description"]');
            const product_benefits = row.querySelector('textarea[name="productBenefits"]');
            const product_usage = row.querySelector('textarea[name="productUsage"]');

            // Log the values of each field
            console.log("Field values:");
            console.log("Product ID:", product_id ? product_id.value : "Not found");
            console.log("Product SKU:", product_sku ? product_sku.value : "Not found");
            console.log("Product Name:", product_name ? product_name.value : "Not found");
            console.log("Product Category:", product_category ? product_category.value : "Not found");
            console.log("HSN Number:", hsn_number ? hsn_number.value : "Not found");
            console.log("Tax Rate:", tax_rate ? tax_rate.value : "Not found");
            console.log("Key Benefits:", key_benefits ? key_benefits.value : "Not found");
            console.log("Description:", description ? description.value : "Not found");
            console.log("Product Benefits:", product_benefits ? product_benefits.value : "Not found");
            console.log("Product Usage:", product_usage ? product_usage.value : "Not found");

            // Check if elements exist before accessing their values
            if (product_id && product_sku && product_name && product_category && hsn_number && tax_rate && key_benefits && description && product_benefits && product_usage) {
                products.push({
                    product_id: product_id.value,
                    product_sku: product_sku.value,
                    product_name: product_name.value,
                    product_category: product_category.value,
                    hsn_number: hsn_number.value,
                    tax_rate: tax_rate.value,
                    key_benefits: key_benefits.value,
                    description: description.value,
                    product_benefits: product_benefits.value,
                    product_usage: product_usage.value,
                    images: [], // Collect image file names if you implement file upload
                    videos: []  // Collect video file names if you implement file upload
                });
                console.log(`Row ${index + 1} data added to products array.`);
            } else {
                console.error(`Row ${index + 1}: One or more fields are missing.`);
                if (!product_id) console.error("Missing product_id");
                if (!product_sku) console.error("Missing product_sku");
                if (!product_name) console.error("Missing product_name");
                if (!product_category) console.error("Missing product_category");
                if (!hsn_number) console.error("Missing hsn_number");
                if (!tax_rate) console.error("Missing tax_rate");
                if (!key_benefits) console.error("Missing key_benefits");
                if (!description) console.error("Missing description");
                if (!product_benefits) console.error("Missing product_benefits");
                if (!product_usage) console.error("Missing product_usage");
                return; // Exit the loop if any field is missing
            }
        });

        console.log("Final products array:", products);

        // Send data to the server
        fetch('config/save_products.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(products)
        })
        .then(response => {
            console.log("Response received from server.");
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log("Data received from server:", data);
            if (data.status === "success") {
                alert(data.message);
                bootstrap.Modal.getInstance(addProductModal).hide();
                // Optionally, refresh the product list or clear the form
            } else {
                alert("Error saving products.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while saving the products.");
        });
    });
});
</script>
