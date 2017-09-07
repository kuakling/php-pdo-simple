<?php
$app['pageTitle'] = "Welcome";
$limit = 6;

$sql = "SELECT product.*, product_type.type_name, supplier.supplier_name FROM product
  INNER JOIN product_type ON product.type_id = product_type.id
  INNER JOIN supplier ON product.supplier_id = supplier.id ORDER BY id DESC LIMIT $limit";
// echo $sql;

$sth = $app['db']->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Last Products</h1>
<div class="row">
  <?php
  foreach ($result as $product) {
    include(__DIR__ . '/product/_item.php');
  }
  ?>
</div>
<hr />
<div class="text-right">
  <a href="?page=product/index" class="btn btn-outline-secondary">
    <i class="fa fa-shopping-bag" aria-hidden="true"></i> สินค้าทั้งหมด
  </a>
</div>
