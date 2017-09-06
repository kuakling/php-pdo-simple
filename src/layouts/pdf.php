<?php
require_once(__DIR__ . '/../../assets/mPDF/vendor/autoload.php');
$mpdfArgs = isset($mpdfArgs) ? $mpdfArgs : ['th', 'A4'];
$mpdf = new mPDF(...$mpdfArgs);
// $mpdf = new mPDF('',    // mode - default ''
//  '',    // format - A4, for example, default ''
//  0,     // font size - default 0
//  '',    // default font family
//  15,    // margin_left
//  15,    // margin right
//  16,     // margin top
//  16,    // margin bottom
//  9,     // margin header
//  9,     // margin footer
//  'L');  // L - landscape, P - portrait
$mpdfSettings = isset($mpdfSettings) ? $mpdfSettings : [];
foreach ($mpdfSettings as $key => $value) {
  if(method_exists($mpdf, $key)){
    $mpdf->$key($value);
  }else{
    $mpdf->$key = $value;
  }
}
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
