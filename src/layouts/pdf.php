<?php
require_once(__DIR__ . '/../../assets/mPDF/vendor/autoload.php');
$mpdf = new mPDF('th');
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $app['pageTitle']; ?></title>
    <link href="assets/css/pdf.css" rel="stylesheet">
  </head>

  <body>
    <?= $app['content'] ?>
  </body>
</html>

<?php
$pdf_html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($pdf_html);
$mpdf->Output();
?>
