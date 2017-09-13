<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $app['pageTitle']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <?php layout_head(); ?>
  </head>

  <body>
    <?php include(__DIR__ . '/components/navbar.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <div class="nav-item">
            <a class="nav-link" href="?page=admin/index">Dashboard</a>
          </div>
          <hr />
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="?page=admin/product/index">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=admin/product_type/index">Product Type</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=admin/supplier/index">Supplier</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="?page=admin/cart/index">Carts</a>
            </li>
          </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <?php layout_flash_messages(); ?>
          <?php echo $app['content']; ?>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.2.1.min.js" ></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <?php layout_end_body(); ?>
  </body>
</html>
