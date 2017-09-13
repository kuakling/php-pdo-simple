<?php admin_init(); ?>
<?php
$sth = $app['db']->prepare("SELECT orders.*, COUNT(orders_items.id) as count_items, user.*, user_profile.*, orders.id as id, orders.status as status
FROM orders
LEFT OUTER JOIN orders_items ON orders.id = orders_items.orders_id
INNER JOIN user ON user.id=orders.user_id
INNER JOIN user_profile ON user.id=user_profile.id
GROUP BY orders.id DESC
");
$sth->execute();
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
      <th>Customer</th>
      <th>Status</th>
      <th>...</th>
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
      <td>
        <a href="?page=admin/cart/view&id=<?=$orders['id']?>" class="text-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
