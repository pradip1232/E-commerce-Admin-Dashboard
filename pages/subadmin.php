<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Sub Admin Management</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubAdminModal">
                    <i class="fas fa-plus"></i> Add New Sub Admin
                </button>
            </div>
        </div>
    </div>

    <!-- Sub Admin Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sub Admin List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Smith</td>
                                    <td>john@example.com</td>
                                    <td>Product Manager</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>2024-02-20 10:30 AM</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editSubAdminModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sarah Johnson</td>
                                    <td>sarah@example.com</td>
                                    <td>Order Manager</td>
                                    <td><span class="badge bg-warning">Inactive</span></td>
                                    <td>2024-02-19 03:45 PM</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editSubAdminModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
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

<!-- Add Sub Admin Modal -->
<div class="modal fade" id="addSubAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Sub Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select">
                            <option>Product Manager</option>
                            <option>Order Manager</option>
                            <option>Customer Manager</option>
                            <option>Content Manager</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Sub Admin</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Sub Admin Modal -->
<div class="modal fade" id="editSubAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" value="John Smith">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="john@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Leave blank to keep current password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select">
                            <option selected>Product Manager</option>
                            <option>Order Manager</option>
                            <option>Customer Manager</option>
                            <option>Content Manager</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option selected>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update Sub Admin</button>
            </div>
        </div>
    </div>
</div> 