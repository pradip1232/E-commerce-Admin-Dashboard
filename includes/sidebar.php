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
        <li class="nav-item dropdown">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="masterDropdown" data-bs-toggle="collapse" data-bs-target="#masterMenu" aria-expanded="false">
                <span><i class="fas fa-plus"></i> Master</span>
                <i class="fas fa-caret-down"></i>
            </a>
            <ul class="collapse list-unstyled ps-3" id="masterMenu">
                <li class="<?php echo ($page == 'products') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=products">
                        <i class="fas fa-boxes"></i> Products
                    </a>
                </li>
                <li class="<?php echo ($page == 'product_category') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=product_category">
                        <i class="fas fa-th-large"></i> Product Categories
                    </a>
                </li>
                <li class="<?php echo ($page == 'hsn-number') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=hsn-number">
                        <i class="fas fa-barcode"></i> Add HSN Number
                    </a>
                </li>
                <li class="<?php echo ($page == 'tax-rate') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=tax-rate">
                        <i class="fas fa-percentage"></i> Add Tax Rate
                    </a>
                </li>
                <li class="<?php echo ($page == 'party-name') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=party-name">
                        <i class="fas fa-user-friends"></i> Party Name
                    </a>
                </li>
                <li class="<?php echo ($page == 'unit-page') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=unit-page">
                        <i class="fas fa-ruler-combined"></i> Unit Page
                    </a>
                </li>
            </ul>

        </li>
        <li class="<?php echo ($page == 'inventory') ? 'active' : ''; ?>">
            <a class="nav-link" href="index.php?page=inventory">
                <i class="fas fa-tags"></i> Inventory
            </a>
        </li>
        <!-- <li class="<?php echo ($page == 'product-tax') ? 'active' : ''; ?>">
            <a href="index.php?page=product-tax">
                <i class="fas fa-tags"></i> Product Tax
            </a>
        </li> -->

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