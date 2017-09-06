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
  <?php foreach ($result as $product) : ?>
  <div class="col-sm-4" style="margin-bottom: 15px; margin-top: 15px;">
    <div class="card">
      <?php $product_image = $product['image'] ? "uploads/product/images/{$product['image']}" : "assets/images/no-image.jpg";?>
      <img class="card-img-top" src="<?= $product_image; ?>" alt="<?= $product['name'] ?>" style="height: 150px;">
      <div class="card-body">
        <h4 class="card-title" style="height: 55px; overflow: hidden;"><?= $product['name'] ?></h4>
        <div class="card-text">
          <h2 class="text-danger"><?= number_format($product['price']) ?> ฿</h2>
        </div>
        <hr />
        <a href="#" class="btn btn-outline-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
