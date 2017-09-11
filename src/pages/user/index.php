<?php user_init(); ?>
<?php
if(isset($_GET['cancel'])) {
  $sth_cancel = $app['db']->prepare("UPDATE orders SET status=0 WHERE id=:id");
  $sth_cancel->execute([
    'id' => $_GET['cancel']
  ]);
  header("location: ?page=user/index");
  exit();
}
?>
<?php
$sth = $app['db']->prepare("SELECT * FROM orders WHERE id=:id");
$sth->execute([
  'id' => $_SESSION['auth']['user']['id']
]);
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$statuses = [
  0 => 'ยกเลิกการสั่งซื้อ',
  1 => 'สั่งซื้อ',
  2 => 'ชำระเงินแล้ว',
  3 => 'จัดส่งสินค้าแล้ว'
];
?>
<table class="table table-striped boder">
  <thead>
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Send Address</th>
      <th>Status</th>
      <th>Cancel</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $orders) : ?>
    <tr>
      <th><?=$orders['id']?></th>
      <td><?=date('d/m/Y h:i:s', strtotime($orders['date']))?></td>
      <td><?=$orders['send_address']?></td>
      <td><?=$statuses[intval($orders['status'])]?></td>
      <td>
        <a href="?page=user/index&cancel=<?=$orders['id']?>" class="text-danger">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
