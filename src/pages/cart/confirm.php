<?php
$carts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if($_POST && count($carts) > 0){
  try {
    $app['db']->beginTransaction();
    $sth = $app['db']->prepare("INSERT INTO orders (send_address, date, status, user_id) VALUES (:send_address, :date, :status, :user_id)");
    $sth->execute([
      'send_address' => $_POST['send_address'],
      'date' => date('Y-m-d h:i:s'),
      'status' => 1,
      'user_id' => $_SESSION['auth']['user']['id']
    ]);
    $orders_id = $app['db']->lastInsertId();

    foreach ($carts as $product_id => $cart) {
      $stmt2 = $app['db']->prepare("INSERT INTO orders_items (product_id, orders_id, amount, price) VALUES (:product_id, :orders_id, :amount, :price)");
      $stmt2->execute([
        'product_id' => $product_id,
        'orders_id' => $orders_id,
        'amount' => $cart['amount'],
        'price' => $cart['price'],
      ]);
    }
    $app['db']->commit();
    unset($_SESSION['cart']);
    header("location: ./");
  }catch(PDOExecption $e) {
    $app['db']->rollback();
    add_flash_message('warning', $e->getMessage());
  }

}
?>
