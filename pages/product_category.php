<div class="container mt-5">
    <h2>Product Category Management</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New Product Category</button>

    <h3 class="mt-5">Categories</h3>
    <input type="text" id="search" class="form-control mb-3" placeholder="Search Categories...">
    <table id="categoriesTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- JS will populate this -->
        </tbody>
    </table>





    <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination">
            <!-- Pagination links will be inserted here -->
        </ul>
    </nav>
</div>

<!-- Modal for Adding Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="subCategoryName" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control" id="subCategoryName" name="subCategoryName">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCategory">Save Category</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadCategories();

        function loadCategories() {
            fetch('config/get_categories.php') // No ?page since pagination is removed
                .then(response => response.json())
                .then(data => {
                    const categories = data.categories;
                    console.log("Categories", categories);

                    const tableBody = document.getElementById('categoriesTable').tBodies[0];
                    tableBody.innerHTML = '';

                    categories.forEach(category => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${category.category_id}</td>
                            <td>${category.category_name}</td>
                            <td>${category.sub_category_name}</td>
                            <td>
                                <button class="btn btn-sm btn-primary editCategory" 
                                    data-id="${category.category_id}"
                                    data-name="${category.category_name}" 
                                    data-subcategory="${category.sub_category_name}">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger deleteCategory" 
                                    data-id="${category.category_id}">
                                    Delete
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error loading categories:', error);
                });
        }
    });
</script>

<script>
    // Add category
    document.getElementById('saveCategory').addEventListener('click', function() {
        const categoryName = document.getElementById('categoryName').value;
        const subCategoryName = document.getElementById('subCategoryName').value;

        fetch('config/save_category.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    categoryName,
                    subCategoryName
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                loadCategories();
                document.getElementById('categoryForm').reset();
                $('#addCategoryModal').modal('hide');
            })
            .catch(() => {
                alert('Error adding category.');
            });
    });

    // Search categories
    document.getElementById('search').addEventListener('keyup', function() {
        const query = this.value;
        fetch(`config/search_categories.php?query=${query}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('categoryTableBody').innerHTML = data;
            });
    });
</script>