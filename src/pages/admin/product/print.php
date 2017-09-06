<?php admin_init(); ?>
<?php
$app['layout'] = __DIR__ . '/../../../layouts/pdf.php';
?>
<?php
$sql = "SELECT product.*, product_type.type_name, supplier.supplier_name FROM product
  INNER JOIN product_type ON product.type_id = product_type.id
  INNER JOIN supplier ON product.supplier_id = supplier.id";


$sth = $app['db']->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
// echo $pageCount;

$app['pageTitle'] = "สินค้า";
?>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 100px;">ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Type</th>
      <th>Sullpier</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
      <th scope="row"><?= $row['id']; ?></th>
      <td><?= $row['name']; ?></td>
      <td><?= $row['price']; ?></td>
      <td><?= $row['qty']; ?></td>
      <td><?= $row['type_name']; ?></td>
      <td><?= $row['supplier_name']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
