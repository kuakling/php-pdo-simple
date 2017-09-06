<?php
require_once(__DIR__ . '/../../assets/mPDF/vendor/autoload.php');
$mpdf = new mPDF();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $app['pageTitle']; ?></title>
  </head>

  <body>
  <?php
  $mpdf->WriteHTML($app['content']);
  $mpdf->Output();
  ?>
  </body>
</html>
