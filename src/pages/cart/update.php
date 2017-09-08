<?php
$app['layout'] = __DIR__ . '/../../layouts/json.php';
$sess_key = key($_POST['amount']);
// echo $sess_key;
$_SESSION['cart'][$sess_key]['amount'] = intval($_POST['amount'][$sess_key]);

// print_r($_SESSION['cart'][$sess_key]);
$arr = [
  'product_id' => $sess_key,
  'amount' => $_SESSION['cart'][$sess_key]['amount'],
];

echo json_encode($arr);
?>
