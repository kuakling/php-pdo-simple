<?php layout_begin_page(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="img/favicon.png">
    <title><?php echo $app['pageTitle']; ?></title>

    <!-- Icons -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link href="assets/simple-line/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="assets/css/style-core-ui.css" rel="stylesheet">
    <?php layout_head(); ?>
</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=admin/index">
                            <i class="icon-speedometer"></i>
                            Dashboard</a>
                    </li>
                </ul>
                <hr />
                <ul class="nav">
                  <li class="nav-item<?= ($_GET['page'] == 'admin/product/index') ? ' open' : ''?>">
                    <a class="nav-link" href="?page=admin/product/index">
                        <i class="fa fa-shopping-bag"></i> Product
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=admin/product_type/index">
                        <i class="fa fa-circle"></i> Product Type
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?page=admin/supplier/index">
                        <i class="fa fa-circle"></i> Supplier
                    </a>
                  </li>
                </ul>
                <hr />

                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link" href="?page=admin/cart/index">
                        <i class="fa fa-shopping-cart"></i> Carts
                    </a>
                  </li>
                </ul>
                <hr />
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link" href="?page=admin/user/index">
                        <i class="fa fa-users"></i> Users
                    </a>
                  </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">


            <div class="container-fluid">

                <?php layout_flash_messages(); ?>
                <?php echo $app['content']; ?>


            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <footer class="app-footer">
        <a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.
        <span class="float-right">Powered by <a href="http://coreui.io">CoreUI</a>
        </span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="assets/js/jquery-3.2.1.min.js" ></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="bower_components/pace/pace.min.js"></script> -->



    <!-- GenesisUI main scripts -->

    <script src="assets/js/app-core-ui.js"></script>





    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <!-- <script src="js/views/main.js"></script> -->
    <?php layout_end_body(); ?>
</body>

</html>
