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

    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron.css" rel="stylesheet">
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
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item<?= (isset($_GET['page']) && $_GET['page'] == 'product/index') ? ' active' : '' ?>">
            <a class="nav-link" href="?page=product/index">Product</a>
          </li>
        </ul>

        <ul class="navbar-nav  my-2 my-lg-0">
          <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['isAuthenticated']){ ?>
          <li class="nav-item">
            <span class="navbar-text"><?php echo $_SESSION['auth']['user']['username']; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=logout">Logout</a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=signup">Signup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=login">Login</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="
    padding-top: 5rem;
    padding-bottom: 2rem;
    background-image: url(assets/images/logo.svg);
    background-repeat: no-repeat;
    background-position: right;
    background-size: contain;
    ">
      <div class="container">
        <h1 class="display-4">อ่าวไทยเครื่องเขียน</h1>
        <hr class="my-4">
        <p class="lead text-muted" style="font-size: 2rem">Stationery shop</p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-3">
          <?php
          $sth_product_type = $app['db']->prepare("SELECT * FROM product_type");
          $sth_product_type->execute();
          $result_product_type = $sth_product_type->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <div class="list-group">
            <?php foreach ($result_product_type as $row) : ?>
            <a href="?page=product/index&product_type=<?=$row['id']?>" class="list-group-item<?= (isset($_GET['product_type']) && $_GET['product_type'] == $row['id']) ? ' active' : '' ?>">
              <?= $row['type_name']; ?>
            </a>
            <?php endforeach; ?>
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
    <script src="assets/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <?php layout_end_body(); ?>
  </body>
</html>
