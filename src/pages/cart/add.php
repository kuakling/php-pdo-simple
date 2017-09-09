<?php
$product_id = $_GET['id'];
if(!isset($_SESSION['cart'][$product_id])){
  $sth = $app['db']->prepare("SELECT * FROM product WHERE id=:id");
  $sth->execute([
    'id' => $product_id
  ]);
  $result = $sth->fetch(PDO::FETCH_ASSOC);
  $_SESSION['cart'][$product_id] = [
    'amount' => 1,
    'price' => $result['price']
  ];
}

header("location: ?page=cart/index");
?>
