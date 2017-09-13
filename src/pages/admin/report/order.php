<?php admin_init(); ?>
<?php
// $app['layout'] = __DIR__ . '/../../../layouts/pdf.php';
$start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
$end_date = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
$find_by_date_range = '';
if($_POST){
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
<form method="post" class="form-inline">
  <div class="form-group mx-sm-3">
    <label for="start_date" class="sr-only">Start Date</label>
    <input type="text" class="form-control date_picker" name="start_date" id="start_date" placeholder="Start Date" value="<?= (isset($_POST['start_date'])) ? $_POST['start_date'] : ''?>">
  </div>
  <div class="form-group mx-sm-3">
    <label for="end_date" class="sr-only">End Date</label>
    <input type="text" class="form-control date_picker" name="end_date" id="end_date" placeholder="End Date" value="<?= (isset($_POST['end_date'])) ? $_POST['end_date'] : ''?>">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Go.</button>
  </div>
</form>
<hr />
<a href="?page=admin/report/order-print&start_date=<?=$start_date?>&end_date=<?=$end_date?>" class="btn btn-secondary" target="_blank">
  Print
</a>
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

<?php
$app['jsScripts'][] = "
$('.date_picker').datepicker({
  format: 'yyyy-mm-dd'
});";

$app['cssFiles'][] = "assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css";
$app['jsFiles'][] = "assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js";
?>
