<?php
include "config/db_con.php";
?>

<main>

    <Content>
        <div class="container">
            <h2 class="mb-4">Tax Rate Master</h2>
            <div id="responseMsg" class="mt-3"></div>
            <form id="taxRateForm">
                <div class="mb-3">
                    <label for="category" class="form-label">Tax Category Name</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>

                <table class="table table-bordered" id="taxTable">
                    <thead>
                        <tr>
                            <th>From Date</th>
                            <th>Tax Rate (%)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="taxBody">
                        <tr>
                            <td><input type="date" name="from_date[]" class="form-control" required></td>
                            <td><input type="number" step="0.01" name="tax_rate[]" class="form-control" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
                        </tr>

                        <!-- Plus button row -->
                        <tr>
                            <td colspan="3">
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-success rounded-circle" onclick="addRow()" style="width: 40px; height: 40px; padding: 0;">
                                        <span class="fs-4">+</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>



                <button type="submit" class="btn btn-primary">Save All</button>
            </form>

        </div>

        <script>
            function addRow() {
                const tbody = document.getElementById('taxBody');
                const buttonRow = tbody.lastElementChild;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
    <td><input type="date" name="from_date[]" class="form-control" required></td>
    <td><input type="number" step="0.01" name="tax_rate[]" class="form-control" required></td>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
  `;

                tbody.insertBefore(newRow, buttonRow);
            }

            function removeRow(button) {
                button.closest('tr').remove();
            }



            function removeRow(button) {
                button.closest("tr").remove();
            }

            document.getElementById("taxRateForm").addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch("config/save-tax-rate.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(res => res.text())
                    .then(data => {
                        document.getElementById("responseMsg").innerHTML = `<div class="alert alert-success">${data}</div>`;
                        this.reset();
                        document.querySelector("#taxTable tbody").innerHTML = `
                            <tr>
                                <td><input type="date" name="from_date[]" class="form-control" required></td>
                                <td><input type="number" step="0.01" name="tax_rate[]" class="form-control" required></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
                            </tr>`;
                    })
                    .catch(err => {
                        document.getElementById("responseMsg").innerHTML = `<div class="alert alert-danger">Error: ${err}</div>`;
                    });
            });
        </script>











        <div class="container">
            <!-- Include Bootstrap & DataTables CSS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

            <div class="container mt-5">
                <h4>Tax Rates Table</h4>
                <table id="taxRatesTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>From Date</th>
                            <th>Tax Rate (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT `category`, `from_date`, `tax_rate` FROM `tax_rates` ORDER BY from_date DESC";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                <td>{$row['category']}</td>
                <td>{$row['from_date']}</td>
                <td>{$row['tax_rate']}%</td>
              </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Include jQuery and DataTables JS -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#taxRatesTable').DataTable({
                        "pageLength": 8,
                        "lengthChange": false,
                        "ordering": false,
                        "language": {
                            search: "_INPUT_",
                            searchPlaceholder: "Search tax rates..."
                        }
                    });
                });
            </script>

        </div>

    </Content>
</main>





















<!-- Button to Open Modal -->
<!-- <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#taxRateModal">
    Add New Tax Rate
</button> -->

<!-- Modal -->
<div class="modal fade" id="taxRateModal" tabindex="-1" aria-labelledby="taxRateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="taxRateForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taxRateModalLabel">Add Tax Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="taxRate" class="form-label">Tax Rate (%)</label>
                    <input type="number" step="0.01" class="form-control" id="taxRate" name="taxRate" required>
                </div>
                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById("taxRateFormm").addEventListener("submit", function(e) {
        e.preventDefault();

        const taxRate = document.getElementById("taxRate").value;
        const startDate = new Date(document.getElementById("startDate").value);
        const endDate = new Date(document.getElementById("endDate").value);

        // Validation: End date must be greater than start date
        if (endDate <= startDate) {
            alert("End Date must be greater than Start Date.");
            return;
        }

        const formData = new FormData(this);

        fetch("config/save-tax-rate.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(response => {
                alert(response);
                this.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('taxRateModal'));
                modal.hide();
            })
            .catch(err => {
                console.error(err);
                alert("Error saving Tax Rate");
            });
    });
</script>