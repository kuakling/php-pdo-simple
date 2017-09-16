<?php $product_image = $product['image'] ? "uploads/product/images/{$product['image']}" : "assets/images/no-image.jpg";?>
<div class="col-sm-4" style="margin-bottom: 15px; margin-top: 15px;">
    <div class="single-product">
        <div class="product-f-image">
            <img src="<?= $product_image; ?>" alt="<?= $product['name'] ?>">
            <div class="product-hover">
                <a href="?page=cart/add&id=<?= $product['id'] ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                <a href="?page=product/view&id=<?= $product['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
            </div>
        </div>

        <h2><a href="?page=product/view&id=<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>

        <div class="product-carousel-price">
            <ins><?= number_format($product['price']) ?> ฿</ins>
        </div>
    </div>
</div>
