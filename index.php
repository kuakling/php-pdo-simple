<?php
$config = include(__DIR__ . '/src/libs/config.php');
$app = include(__DIR__ . '/src/libs/app.php');
$app['pageName'] = (isset($_GET['page'])) ? $_GET['page'] : 'index';
$app['pageFile'] = __DIR__ . '/src/pages/' . $app['pageName'] . '.php';
// echo $file;
ob_start();
if(is_file($app['pageFile'])){
  include($app['pageFile']);
}else{
  echo 'Page not found.';
  header("HTTP/1.0 404 Not Found");
}
$app['content'] = ob_get_contents();
ob_end_clean();
?>
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

    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron.css" rel="stylesheet">
    <?php
      foreach ($app['cssFiles'] as $key => $cssFile) {
        echo "<link href=\"$cssFile\" rel=\"stylesheet\">\n";
      }
    ?>

    <?php
    if(count($app['cssScripts']) > 0){
      echo "<style>";
      foreach ($app['cssScripts'] as $key => $cssScript) {
        echo $cssScript . "\n";
      }
      echo "</style>";
    }
    ?>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>

        <ul class="navbar-nav  my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Signup</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="#" class="list-group-item active">
              Cras justo odio
            </a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
          </div>
        </div>
        <div class="col-md-9">
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

    <?php
      foreach ($app['jsFiles'] as $key => $jsFile) {
        echo "<script src=\"$jsFile\"></script>\n";
      }
    ?>

    <?php
    if(count($app['jsScripts']) > 0){
      echo "<script type=\"text/javascript\">\n";
      echo "$( document ).ready(function() {\n";
      foreach ($app['jsScripts'] as $key => $jsScript) {
        echo $jsScript . "\n";
      }
      echo "});\n";
      echo "</script>\n";
    }
    ?>
  </body>
</html>

<?php $app['db'] = null; ?>
