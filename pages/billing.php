<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Billing & Invoices</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateInvoiceModal">
                    <i class="fas fa-plus"></i> Generate New Invoice
                </button>
            </div>
        </div>
    </div>

    <!-- Billing Statistics -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Total Revenue</div>
                        <div class="h5 mb-0 font-weight-bold text-white">45,000</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 4.5%
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- <i class="fas fa-dollar-sign fa-2x text-white"></i> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Paid Invoices</div>
                        <div class="h5 mb-0 font-weight-bold text-white">156</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 2.3%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-check-circle fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card warning">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Pending Payments</div>
                        <div class="h5 mb-0 font-weight-bold text-white">23</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-down"></i> 1.2%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-clock fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card danger">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Overdue Payments</div>
                        <div class="h5 mb-0 font-weight-bold text-white">8</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 0.8%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-exclamation-circle fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Invoices</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#INV-001</td>
                                    <td>John Doe</td>
                                    <td>1,500</td>
                                    <td>2024-02-20</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#INV-002</td>
                                    <td>Jane Smith</td>
                                    <td>2,300</td>
                                    <td>2024-02-19</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Generate Invoice Modal -->
<div class="modal fade" id="generateInvoiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate New Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <select class="form-select">
                            <option>Select Customer</option>
                            <option>John Doe</option>
                            <option>Jane Smith</option>
                            <option>Mike Johnson</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Items</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-select">
                                                <option>Product A</option>
                                                <option>Product B</option>
                                                <option>Product C</option>
                                            </select>
                                        </td>
                                        <td><input type="number" class="form-control" value="1"></td>
                                        <td><input type="number" class="form-control" value="100"></td>
                                        <td>$100</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end">
                                            <button type="button" class="btn btn-sm btn-success">
                                                <i class="fas fa-plus"></i> Add Item
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Generate Invoice</button>
            </div>
        </div>
    </div>
</div> 