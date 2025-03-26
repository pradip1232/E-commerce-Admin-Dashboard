<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="ms-auto">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="badge bg-danger">3</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">New Order Received</a></li>
                    <li><a class="dropdown-item" href="#">Low Stock Alert</a></li>
                    <li><a class="dropdown-item" href="#">System Update</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle"></i>
                    Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav> 