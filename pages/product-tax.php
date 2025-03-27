<div class="container mt-5">
    <h2>Product Tax Management</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTaxModal">Add New Tax</button>

    <h3 class="mt-5">Taxes</h3>
    <input type="text" id="searchTax" class="form-control mb-3" placeholder="Search Taxes...">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>IGST</th>
                <th>CGST</th>
                <th>SGST</th>
                <th>Starting Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="taxTableBody">
            <!-- Dynamic content will be inserted here -->
        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination" id="taxPagination">
            <!-- Pagination links will be inserted here -->
        </ul>
    </nav>
</div>

<!-- Modal for Adding Tax -->
<div class="modal fade" id="addTaxModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaxModalLabel">Add New Tax</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taxForm">
                    <div class="mb-3">
                        <label for="igst" class="form-label">IGST (%)</label>
                        <input type="number" class="form-control" id="igst" name="igst" required>
                        <div class="invalid-feedback" id="igstFeedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="cgst" class="form-label">CGST (%)</label>
                        <input type="number" class="form-control" id="cgst" name="cgst" oninput="validateTaxFields()" required>
                        <div class="invalid-feedback" id="cgstFeedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="sgst" class="form-label">SGST (%)</label>
                        <input type="number" class="form-control" id="sgst" name="sgst" oninput="validateTaxFields()" required>
                        <div class="invalid-feedback" id="sgstFeedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="startingDate" class="form-label">Starting Date</label>
                        <input type="date" class="form-control" id="startingDate" name="startingDate" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveTax">Save Tax</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadTaxes();

   

    // Add tax
    document.getElementById('saveTax').addEventListener('click', function() {
        const igst = document.getElementById('igst').value;
        const cgst = document.getElementById('cgst').value;
        const sgst = document.getElementById('sgst').value;
        const startingDate = document.getElementById('startingDate').value;

        fetch('config/save_tax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ igst, cgst, sgst, startingDate })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadTaxes();
            document.getElementById('taxForm').reset();
            $('#addTaxModal').modal('hide');
        })
        .catch(() => {
            alert('Error adding tax.');
        });
    });

   
});

// Function to validate tax fields
function validateTaxFields() {
    const igst = parseFloat(document.getElementById('igst').value) || 0;
    const cgst = parseFloat(document.getElementById('cgst').value) || 0;
    const sgst = parseFloat(document.getElementById('sgst').value) || 0;

    let valid = true;

    // Reset feedback messages
    document.getElementById('igstFeedback').innerText = '';
    document.getElementById('cgstFeedback').innerText = '';
    document.getElementById('sgstFeedback').innerText = '';

    // Validate CGST
    if (cgst < 0 || cgst > igst) {
        document.getElementById('cgstFeedback').innerText = 'CGST must be between 0 and IGST.';
        valid = false;
    }

    // Validate SGST
    if (sgst < 0 || sgst > igst) {
        document.getElementById('sgstFeedback').innerText = 'SGST must be between 0 and IGST.';
        valid = false;
    }

    // Calculate remaining tax
    if (valid) {
        if (cgst > 0) {
            document.getElementById('sgst').value = (igst - cgst).toFixed(2);
        } else if (sgst > 0) {
            document.getElementById('cgst').value = (igst - sgst).toFixed(2);
        }
    }

    // Live validation for IGST
    if (cgst > igst) {
        document.getElementById('cgstFeedback').innerText = 'CGST cannot be greater than IGST.';
    }
    if (sgst > igst) {
        document.getElementById('sgstFeedback').innerText = 'SGST cannot be greater than IGST.';
    }
}

function loadTaxes(page = 1) {
    fetch(`config/get_taxes.php?page=${page}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('taxTableBody').innerHTML = data.taxes; // Update the table body
            document.getElementById('taxPagination').innerHTML = data.pagination; // Update pagination
        })
        .catch(error => {
            console.error('Error loading taxes:', error);
        });
}
</script>


