
<?php
include 'config/db_con.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Total Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-white">$40,000</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 3.48%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-calendar fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-white">215</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 2.15%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-shopping-cart fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card warning">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Total Products</div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                            <?php
                                // Fetch total products from the database
                                $query = "SELECT COUNT(*) as total FROM products"; // Assuming 'products' is the table name
                                $result = mysqli_query($conn, $query);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total'];
                            ?>
                        </div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-up"></i> 1.25%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-box fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card danger">
                <div class="row">
                    <div class="col-8">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Low Stock Items</div>
                        <div class="h5 mb-0 font-weight-bold text-white">12</div>
                        <div class="mt-2 text-xs text-white">
                            <i class="fas fa-arrow-down"></i> 0.5%
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-exclamation-triangle fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>
                                    <td>John Doe</td>
                                    <td>Product A</td>
                                    <td>$150</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#12346</td>
                                    <td>Jane Smith</td>
                                    <td>Product B</td>
                                    <td>$200</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
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