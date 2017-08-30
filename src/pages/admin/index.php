<?php
$app['layout'] = __DIR__ . '/../../layouts/dashboard.php';
if(!isset($_SESSION['auth']) || !$_SESSION['auth']['isAuthenticated']){
  header('location: ?page=login');
}else{
  if(!$_SESSION['auth']['user']['is_admin']){
    $app['flashMessages'][] = [
      'type' => 'danger',
      'text' => '403 Not Allow.'
    ];
    exit();
  }
}
?>
ยินดีต้อนรับ
