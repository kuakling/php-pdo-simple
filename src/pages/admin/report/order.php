<?php admin_init(); ?>
<?php
// $app['layout'] = __DIR__ . '/../../../layouts/pdf.php';
$find_by_date_range = '';
if($_POST){
  $find_by_date_range = " AND orders.date >= DATE('{$_POST['start_date']}') AND orders.date <= DATE('{$_POST['end_date']}')";
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
<form method="post">
  <input type="text" name="start_date" value="2017-09-01">
  <input type="text" name="end_date" value="2017-09-30">
  <button type="submit">Go.</button>
</form>
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
