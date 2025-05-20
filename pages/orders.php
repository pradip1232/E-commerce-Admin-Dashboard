<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Purchased Orders</h1>
                <div>
                    <!-- <button class="btn btn-success me-2">
                        <i class="fas fa-file-export"></i> Export Orders
                    </button> -->
                    <button class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter Orders
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Statistics -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-white">245</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 3.2%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-shopping-cart fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Completed Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-white">180</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 2.8%
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
                            Pending Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-white">45</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-down"></i> 1.5%
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
                            Cancelled Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-white">20</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 0.8%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-times-circle fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Products</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD-001</td>
                                    <td>John Doe</td>
                                    <td>3 items</td>
                                    <td>$450</td>
                                    <td>2024-02-20</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-002</td>
                                    <td>Jane Smith</td>
                                    <td>2 items</td>
                                    <td>$280</td>
                                    <td>2024-02-19</td>
                                    <td><span class="badge bg-warning">Processing</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fas fa-print"></i>
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

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Customer Information</h6>
                        <p>Name: John Doe<br>
                        Email: john@example.com<br>
                        Phone: +1 234 567 890<br>
                        Address: 123 Main St, City, Country</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Order Information</h6>
                        <p>Order ID: #ORD-001<br>
                        Date: 2024-02-20<br>
                        Status: Completed<br>
                        Payment Method: Credit Card</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product A</td>
                                <td>2</td>
                                <td>$150</td>
                                <td>$300</td>
                            </tr>
                            <tr>
                                <td>Product B</td>
                                <td>1</td>
                                <td>$150</td>
                                <td>$150</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                <td>$450</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Shipping:</strong></td>
                                <td>$20</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>$470</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h6>Order Status Timeline</h6>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-date">2024-02-20 10:30 AM</div>
                                <div class="timeline-content">
                                    <h6>Order Placed</h6>
                                    <p>Order was successfully placed</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2024-02-20 11:15 AM</div>
                                <div class="timeline-content">
                                    <h6>Payment Confirmed</h6>
                                    <p>Payment was successfully processed</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2024-02-20 02:30 PM</div>
                                <div class="timeline-content">
                                    <h6>Order Shipped</h6>
                                    <p>Order has been shipped to the customer</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2024-02-21 10:00 AM</div>
                                <div class="timeline-content">
                                    <h6>Order Delivered</h6>
                                    <p>Order has been delivered to the customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Print Invoice</button>
            </div>
        </div>
    </div>
</div> 