<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title><?php echo $app['pageTitle']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <style>
    body {
      padding-top: 4.5rem;
    }
    </style>
    <?php layout_head(); ?>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">
        <img src="assets/images/logo.svg" width="30" height="30" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item<?= (!isset($_GET['page'])) ? ' active' : '' ?>">
            <a class="nav-link" href="index.php">
              <i class="fa fa-home" aria-hidden="true"></i>
              Home <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item<?= (isset($_GET['page']) && $_GET['page'] == 'product/index') ? ' active' : '' ?>">
            <a class="nav-link" href="?page=product/index">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              Product
            </a>
          </li>
          <li class="nav-item<?= (isset($_GET['page']) && $_GET['page'] == 'cart/index') ? ' active' : '' ?>">
            <a class="nav-link" href="?page=cart/index">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              Cart
              <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
              <span class="badge badge-pill badge-danger"><?= count($_SESSION['cart']) ?></span>
              <?php } ?>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav  my-2 my-lg-0">
          <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['isAuthenticated']){ ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=user/index">
              <i class="fa fa-user" aria-hidden="true"></i>
              <?php echo $_SESSION['auth']['user']['username']; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=logout">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              Logout
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=signup">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              Signup
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=login">
              <i class="fa fa-sign-in" aria-hidden="true"></i>
              Login
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="./" class="list-group-item<?= (!isset($_GET['page'])) ? ' active' : '' ?>">
              หน้าแรก
            </a>
            <a href="?page=user/index" class="list-group-item<?= (isset($_GET['page']) && $_GET['page'] == 'user/index') ? ' active' : '' ?>">
              ประวัติการสั่งซื้อ
            </a>
          </div>

          <hr />
          <div class="list-group">
            <a href="?page=user/profile" class="list-group-item<?= (isset($_GET['page']) && $_GET['page'] == 'user/profile') ? ' active' : '' ?>">
              ข้อมูลส่วนตัว
            </a>
            <a href="?page=user/change-password" class="list-group-item<?= (isset($_GET['page']) && $_GET['page'] == 'user/change-password') ? ' active' : '' ?>">
              เปลี่ยนรหัสผ่าน
            </a>
          </div>
        </div>
        <div class="col-md-9">
          <?php layout_flash_messages(); ?>
          <?php echo $app['content']; ?>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2017</p>
      </footer>
    </div> <!-- /container -->


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
