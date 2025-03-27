<div class="container mt-5">
    <h2>Product Category Management</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New Product Category</button>

    <h3 class="mt-5">Categories</h3>
    <input type="text" id="search" class="form-control mb-3" placeholder="Search Categories...">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Sub Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="categoryTableBody">
            <!-- Dynamic content will be inserted here -->
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

    // Load categories with pagination
    function loadCategories(page = 1) {
        fetch(`config/get_categories.php?page=${page}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('categoryTableBody').innerHTML = data.categories;
                document.getElementById('pagination').innerHTML = data.pagination;
            })
            .catch(error => {
                console.error('Error loading categories:', error);
            });
    }

    // Add category
    document.getElementById('saveCategory').addEventListener('click', function() {
        const categoryName = document.getElementById('categoryName').value;
        const subCategoryName = document.getElementById('subCategoryName').value;

        fetch('config/save_category.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ categoryName, subCategoryName })
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
});
</script>
