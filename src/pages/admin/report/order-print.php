<?php admin_init(); ?>
<?php
$app['layout'] = __DIR__ . '/../../../layouts/pdf.php';
$start_date = (isset($_GET['start_date'])) ? $_GET['start_date'] : '';
$end_date = (isset($_GET['end_date'])) ? $_GET['end_date'] : '';
$find_by_date_range = '';
if($start_date && $end_date){
  $find_by_date_range = " AND orders.date >= '{$start_date}' AND orders.date <= '{$end_date} 23:59:59'";
}

$sql = "SELECT orders.*, COUNT(orders_items.id) as count_items, user.*, user_profile.*, orders.id as id, orders.status as status
FROM orders
LEFT OUTER JOIN orders_items ON orders.id = orders_items.orders_id
INNER JOIN user ON user.id=orders.user_id
INNER JOIN user_profile ON user.id=user_profile.id
WHERE orders.status >= 2{$find_by_date_range}
GROUP BY orders.id DESC
";
// echo $sql;
$sth = $app['db']->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$statuses = cart_stateses();
?>
<h3>แสดงรายการสั่งซื้อสินค้าจากวันที่ <?=date('d/m/Y', strtotime($start_date))?> ถึง <?=date('d/m/Y', strtotime($end_date))?></h3>
<table class="table table-striped border">
  <thead>
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Send Address</th>
      <th>Count</th>
      <th>Customer</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $orders) : ?>
    <tr>
      <th><?=$orders['id']?></th>
      <td><?=date('d/m/Y h:i:s', strtotime($orders['date']))?></td>
      <td><?=$orders['send_address']?></td>
      <td><?=$orders['count_items']?></td>
      <td><?=$orders['fullname']?></td>
      <td><?=$statuses[intval($orders['status'])]?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
