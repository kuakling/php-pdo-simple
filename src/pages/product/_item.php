<div class="col-sm-4" style="margin-bottom: 15px; margin-top: 15px;">
  <div class="card">
    <?php $product_image = $product['image'] ? "uploads/product/images/{$product['image']}" : "assets/images/no-image.jpg";?>
    <img class="card-img-top" src="<?= $product_image; ?>" alt="<?= $product['name'] ?>" style="height: 150px;">
    <div class="card-body">
      <h4 class="card-title" style="height: 55px; overflow: hidden;">
        <a href="?page=product/view&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
      </h4>
      <div class="card-text">
        <h2 class="text-danger"><?= number_format($product['price']) ?> ฿</h2>
      </div>
      <hr />
      <a href="?page=cart/add&id=<?= $product['id'] ?>" class="btn btn-outline-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> หยิบใส่ตะกร้า</a>
    </div>
  </div>
</div>
