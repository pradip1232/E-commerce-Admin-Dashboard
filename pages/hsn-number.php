<?php
include 'config/db_con.php';
?>




<!-- Button to Open Modal -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hsnModal">
    Add New HSN Number
</button>

<!-- Modal -->
<div class="modal fade" id="hsnModal" tabindex="-1" aria-labelledby="hsnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="hsnForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hsnModalLabel">Add HSN Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="hsnNumber" class="form-label">HSN Number</label>
                    <input type="text" class="form-control" id="hsnNumber" name="hsnNumber" required>
                </div>
                <div class="mb-3">
                    <label for="hsnDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="hsnDescription" name="hsnDescription"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap & JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("hsnForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("config/save-hsn-number.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(response => {
                alert(response);
                this.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('hsnModal'));
                modal.hide();
            })
            .catch(err => {
                console.error(err);
                alert("Error saving HSN Number");
            });
    });
</script>