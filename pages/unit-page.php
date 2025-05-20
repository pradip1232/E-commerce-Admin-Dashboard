<!-- Button to trigger modal -->
<button class="btn btn-primary" id="newUnitBtn">New</button>

<!-- Modal -->
<div class="modal fade" id="unitModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="unitForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Unit of Measure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Unit of Measure</label>
                        <input type="text" name="unit" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category" id="categoryDropdown" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            <option value="1">Weight</option>
                            <option value="2">Length</option>
                            <option value="3">Volume</option>
                            <option value="4">Quantity</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Indian GST UQC</label>
                        <select name="gst_uqc" id="uqcDropdown" class="form-select" required>
                            <option value="">-- Select UQC --</option>
                            <option value="BOX">Box</option>
                            <option value="BAG">Bag</option>
                            <option value="NOS">Numbers</option>
                            <option value="PCS">Pieces</option>
                            <option value="KG">Kilogram</option>
                            <option value="LTR">Liter</option>
                            <option value="MTR">Meter</option>
                            <option value="SET">Set</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Type</label>
                        <select name="type" class="form-select" required>
                            <option value="smaller">Smaller than reference</option>
                            <option value="larger">Larger than reference</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Ratio</label>
                        <input type="number" step="0.00001" name="ratio" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Rounding Precision</label>
                        <input type="number" step="0.00001" name="rounding" class="form-control" value="0.01" required>
                    </div>
                    <div class="col-md-6">
                        <label>Active</label><br>
                        <input type="checkbox" name="active" checked>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#newUnitBtn').click(function() {
            // Show modal
            $('#unitModal').modal('show');

            // Load dropdown data
            $.ajax({
                url: 'get_dropdown_data.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#categoryDropdown').html(response.categories);
                    $('#uqcDropdown').html(response.uqcs);
                }
            });
        });

        // Submit form
        $('#unitForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'config/save_unit.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    alert(res);
                    $('#unitModal').modal('hide');
                    // Optionally reload list/table here
                }
            });
        });
    });
</script>