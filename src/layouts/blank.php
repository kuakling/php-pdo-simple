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

  <?php foreach ($app['flashMessages'] as $key => $flashMessage) : ?>
    <div class="alert alert-<?php echo $flashMessage['type']; ?>" role="alert">
      <?php echo $flashMessage['text']; ?>
    </div>
  <?php endforeach; ?>
  
  <?php echo $app['content']; ?>
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
