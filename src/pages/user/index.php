<?php user_init(); ?>
<?php
$change_status = false;
if(isset($_GET['cancel']) || isset($_GET['resume'])) {
  $change_status = true;
  $orders_id = isset($_GET['cancel']) ? $_GET['cancel'] : $_GET['resume'];
  $status = isset($_GET['cancel']) ? 0 : 1;
}

if($change_status){
  $sth_check = $app['db']->prepare("SELECT * FROM orders WHERE id=:id");
  $sth_check->execute([
    'id' => $orders_id
  ]);
  $result_check = $sth_check->fetch(PDO::FETCH_ASSOC);

  if($result_check['user_id'] == $_SESSION['auth']['user']['id'] && intval($result_check['status']) <= 1){
    $sth_cancel = $app['db']->prepare("UPDATE orders SET status=:status WHERE id=:id");
    $sth_cancel->execute([
      'status' => $status,
      'id' => $orders_id
    ]);
    header("location: ?page=user/index");
    exit();
  }else{
    add_flash_message('danger', 'การเปลี่ยนแปลงสถานะรายการสั่งซื้อสินค้าไม่ถูกต้อง');
  }
}
?>
<?php
$sth = $app['db']->prepare("SELECT orders.*, COUNT(orders_items.id) as count_items
FROM orders LEFT OUTER JOIN orders_items
ON orders.id = orders_items.orders_id
WHERE orders.user_id=:user_id
GROUP BY orders.id
");
$sth->execute([
  'user_id' => $_SESSION['auth']['user']['id']
]);
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$statuses = cart_stateses();
?>
<table class="table table-striped border">
  <thead>
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Send Address</th>
      <th>Count</th>
      <th>Status</th>
      <th>...</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $orders) : ?>
    <tr>
      <th><?=$orders['id']?></th>
      <td><a href="?page=user/cart-history&id=<?=$orders['id']?>"><?=date('d/m/Y h:i:s', strtotime($orders['date']))?></a></td>
      <td><?=$orders['send_address']?></td>
      <td><?=$orders['count_items']?></td>
      <td><?=$statuses[intval($orders['status'])]?></td>
      <td>
        <?php
        $ordes_status = intval($orders['status']);
        if($ordes_status == 0) { ?>
        <a href="?page=user/index&resume=<?=$orders['id']?>" class="text-info">
          <i class="fa fa-play" aria-hidden="true"></i>
        </a>
        <?php }elseif ($ordes_status == 1) { ?>
        <a href="?page=user/index&cancel=<?=$orders['id']?>" class="text-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        <?php }elseif ($ordes_status == 2) { ?>
        <i class="fa fa-money" aria-hidden="true"></i>
        <?php }elseif ($ordes_status == 3) { ?>
        <i class="fa fa-truck" aria-hidden="true"></i>
        <?php } ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
