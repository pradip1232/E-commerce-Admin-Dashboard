<!-- Sidebar -->
<nav id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>">
            <a href="index.php?page=dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="<?php echo ($page == 'products') ? 'active' : ''; ?>">
            <a href="index.php?page=products">
                <i class="fas fa-box"></i> Products
            </a>
        </li>
        <li class="<?php echo ($page == 'subadmin') ? 'active' : ''; ?>">
            <a href="index.php?page=subadmin">
                <i class="fas fa-users"></i> Sub Admin
            </a>
        </li>
        <li class="<?php echo ($page == 'billing') ? 'active' : ''; ?>">
            <a href="index.php?page=billing">
                <i class="fas fa-file-invoice-dollar"></i> Billing
            </a>
        </li>
        <li class="<?php echo ($page == 'orders') ? 'active' : ''; ?>">
            <a href="index.php?page=orders">
                <i class="fas fa-shopping-cart"></i> Purchased Orders
            </a>
        </li>
    </ul>
</nav> 