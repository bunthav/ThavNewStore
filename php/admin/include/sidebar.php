<!-- Spinner Start -->
<div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Wellcome</h3>
        </a>
        <a href="index.php?p=admin">
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="img/icons/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">Bunthav</h6>
                    <span>Admin</span>
                </div>
            </div>
        </a>

        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link 
                    <?php echo ($p == 'dashboard' || empty($p) ? 'active' : ''); ?>">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <a href="index.php?p=design" class="nav-item nav-link 
                    <?php echo ($p == 'design' ? 'active' : ''); ?>">
                <i class="fa fa-image me-2"></i>Design
            </a>

            <a href="index.php?p=slideshow" class="nav-item nav-link 
                    <?php echo ($p == 'slideshow' ? 'active' : ''); ?>">
                <i class="fa fa-image me-2"></i>SlideShow
            </a>

            <a href="index.php?p=category" class="nav-item nav-link 
                    <?php echo ($p == "category" ? 'active' : ''); ?>">
                <i class="fa fa-table me-2"></i>Category
            </a>

            <a href="index.php?p=products" class="nav-item nav-link 
                    <?php echo ($p == 'products' ? 'active' : ''); ?>">
                <i class="fa fa-bag-shopping me-2"></i>Products
            </a>

            <a href="index.php?p=shipment" class="nav-item nav-link 
                    <?php echo ($p == 'shipment' ? 'active' : ''); ?>">
                <i class="fa fa-truck me-2"></i>Shipment
            </a>

            <a href="index.php?p=orders" class="nav-item nav-link 
                    <?php echo ($p == "orders" ? 'active' : ''); ?>">
                <i class="fa fa-business-time me-2"></i>Orders
            </a>
            <a href="index.php?p=accounts" class="nav-item nav-link 
                    <?php echo ($p == "accounts" ? 'active' : ''); ?>">
                <i class="fa fa-key me-2"></i>Accounts
            </a>
            <!-- <a href="index.php" class="nav-item nav-link ">
                        <i class="fa fa-image me-2"></i>SlideShow
                    </a>
                    <a href="index.php" class="nav-item nav-link ">
                        <i class="fa fa-image me-2"></i>SlideShow
                    </a> -->

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.php" class="dropdown-item">Buttons</a>
                    <a href="typography.php" class="dropdown-item">Typography</a>
                    <a href="element.php" class="dropdown-item">Other Elements</a>
                    <a href="widget.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.php" class="dropdown-item">Sign In</a>
                    <a href="signup.php" class="dropdown-item">Sign Up</a>
                    <a href="404.php" class="dropdown-item">404 Error</a>
                    <a href="blank.php" class="dropdown-item">Blank Page</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->