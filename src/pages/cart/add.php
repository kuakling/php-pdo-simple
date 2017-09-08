<?php
$product_id = $_GET['id'];
if(!isset($_SESSION['cart'][$product_id])){
  $_SESSION['cart'][$product_id] = [
    'amount' => 1
  ];
}

header("location: ?page=cart/index");
?>
