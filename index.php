<?php
session_start();
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
<?php include($app['layout']); ?>
<?php $app['db'] = null; ?>
