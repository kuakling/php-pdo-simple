<?php
$product_id = $_GET['id'];
$_SESSION['cart'][$product_id] = [
  'amount' => 1
];

header("location: ?page=cart/index");
?>
