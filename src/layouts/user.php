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

    <?php include(__DIR__ . '/components/navbar.php'); ?>

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
