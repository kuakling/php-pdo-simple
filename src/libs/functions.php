<?php
function admin_verify() {
  global $app;
  if(!isset($_SESSION['auth']) || !$_SESSION['auth']['isAuthenticated']){
    header('location: ?page=login');
  }else{
    if(!$_SESSION['auth']['user']['is_admin']){
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
?>
