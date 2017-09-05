<?php
function admin_verify() {
  global $app;
  if(!isset($_SESSION['auth']) || !$_SESSION['auth']['isAuthenticated']){
    header('location: ?page=login');
    exit();
  }else{
    if(!$_SESSION['auth']['user']['is_admin']){
      header('HTTP/1.0 403 Forbidden');
      $app['flashMessages'][] = [
        'type' => 'danger',
        'text' => '403 Not Allow.'
      ];
      $app['content'] = "<h2 class=\"text-danger text-center\">{$_SESSION['auth']['user']['username']} ไม่ได้รับการอนุญาตให้ใช้งานหน้านี้</h2>";
      include(__DIR__ . '/../layouts/blank.php');
      exit();
    }
  }
}

function admin_init() {
  global $app;
  admin_verify();
  $app['layout'] = __DIR__ . '/../layouts/dashboard.php';
}

function layout_head() {
  global $app;
  foreach ($app['cssFiles'] as $key => $cssFile) {
    echo "<link href=\"$cssFile\" rel=\"stylesheet\">\n";
  }

  if(count($app['cssScripts']) > 0){
    echo "<style>";
    foreach ($app['cssScripts'] as $key => $cssScript) {
      echo $cssScript . "\n";
    }
    echo "</style>";
  }
}

function layout_flash_messages() {
  global $app;
  foreach ($app['flashMessages'] as $key => $flashMessage) {
    echo "<div class=\"alert alert-{$flashMessage['type']}\" role=\"alert\">{$flashMessage['text']}</div>";
  }
}

function layout_end_body() {
  global $app;
  foreach ($app['jsFiles'] as $key => $jsFile) {
    echo "<script src=\"$jsFile\"></script>\n";
  }

  if(count($app['jsScripts']) > 0){
    echo "<script type=\"text/javascript\">\n";
    echo "$( document ).ready(function() {\n";
    foreach ($app['jsScripts'] as $key => $jsScript) {
      echo $jsScript . "\n";
    }
    echo "});\n";
    echo "</script>\n";
  }
}


function sql_operators() {
  return [
    '=' => '=',
    '>' => '>',
    '>=' => '>=',
    '<' => '<',
    '<=' => '<=',
    '!=' => '!=',
    'LIKE' => 'LIKE %...%'
  ];
}
?>
