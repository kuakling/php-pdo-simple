<?php
$sql = "SELECT product.*, product_type.type_name FROM product
  INNER JOIN product_type ON product.type_id = product_type.id
  WHERE product.id=:id";
// echo $sql;
$sth = $app['db']->prepare($sql);
$sth->execute([
  'id' => $_GET['id']
]);
$product = $sth->fetch(PDO::FETCH_ASSOC);


// print_r($product);
?>
<?php if($sth->rowCount() > 0) { ?>
  <?php $app['pageTitle'] = "รายละเอียดสินค้า: {$product['name']}"; ?>
<div class="row">
  <div class="col-sm-4">
    <?php $product_image = $product['image'] ? "uploads/product/images/{$product['image']}" : "assets/images/no-image.jpg";?>
    <img class="card-img-top" src="<?= $product_image; ?>" alt="<?= $product['name'] ?>">
  </div>
  <div class="col-sm-8">
    <table class="table border">
      <tbody>
        <tr>
          <th style="width: 100px;">Name</th>
          <td><h3><?= $product['name'] ?></h3></td>
        </tr>
        <tr>
          <th>Detail</th>
          <td><?= $product['product_detail'] ?></td>
        </tr>
        <tr>
          <th>Price</th>
          <td><h3 class="text-danger"><?= number_format($product['price']) ?> ฿</h3></td>
        </tr>
        <tr>
          <th>Size</th>
          <td><?= $product['size'] ?></td>
        </tr>
        <tr>
          <th>Type</th>
          <td><?= $product['type_name'] ?></td>
        </tr>
        <tr>
          <th></th>
          <td>
            <a href="#" class="btn btn-outline-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php }else {
  $app['flashMessages'][] = [
    'type' => 'warning',
    'text' => 'Product not found.',
  ];
  $app['pageTitle'] = "Error: HTTP/1.0 400 Bad Request";
  header("HTTP/1.0 400 Bad Request");
}
?>
<hr />
<div class="text-center">
  <a href="./" class="btn btn-outline-secondary"><i class="fa fa-home" aria-hidden="true"></i> กลับหน้าหลัก</a>
</div>
