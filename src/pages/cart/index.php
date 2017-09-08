<table class="table table-striped border">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>รหัสสินค้า</th>
      <th>ชื่อสินค้า</th>
      <th class="text-right">ราคา/หน่วย</th>
      <th class="text-right" style="width: 130px;">จำนวน</th>
      <th class="text-right">ราคารวม</th>
      <th>...</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $carts = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $i = 0;
    $price_total = 0;
    foreach ($carts as $product_id => $item) :
      $i++;
    ?>
    <?php
    $sql_product = "SELECT product.*, product_type.type_name FROM product
      INNER JOIN product_type ON product.type_id = product_type.id
      WHERE product.id=:id";
    $sth_product = $app['db']->prepare($sql_product);
    $sth_product->execute([
      'id' => $product_id
    ]);
    $product = $sth_product->fetch(PDO::FETCH_ASSOC);

    $price_all = $product['price'] * $item['amount'];
    $price_total += $price_all;
    ?>
    <tr>
      <th scope="row"><?= $i ?></th>
      <td><?= $product_id; ?></td>
      <td><?= $product['name']; ?></td>
      <td class="text-right">
        <?= number_format($product['price']); ?>
        <input type="hidden" class="price_<?=$product_id?>" value="<?=$product['price']?>">
      </td>
      <td class="text-right">
        <form class="update_amount">
          <div class="form-group">
            <div class="input-group mb-2 mb-sm-0">
              <input type="text" class="form-control amount_<?=$product_id?>" name="amount[<?=$product_id?>]" value="<?= $item['amount']; ?>">
              <button class="btn btn-outline-success my-2 my-sm-0 input-group-addon" type="submit">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
            </div>
        </form>
      </td>
      <td class="text-right">
        <span class="price_all_display_<?=$product_id?>"><?= number_format($price_all); ?></span>
        <input type="hidden" class="price_all_<?=$product_id?>" name="price_all[<?=$product_id?>]" value="<?=$price_all?>">
      </td>
      <td><a href="?page=cart/delete&id=<?=$product_id?>" class="text-danger"><i class="fa fa-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot class="table-warning" style="font-weight: bold;">
    <tr>
      <td colspan="5" class="text-right">ราคาสุทธิ</td>
      <td class="text-right price_total"><?=number_format($price_total)?></td>
      <td></td>
    </tr>
  </tfoot>
</table>

<div class="text-right">
  <a href="?page=cart/clear" class="btn btn-outline-danger"><i class="fa fa-trash"></i> ยกเลิกตะกร้าสินค้า</a>
</div>
<?php
$app['jsScripts'][] = "
$('.update_amount').submit(function(e) {
  e.preventDefault();

  $.ajax({
    url: '?page=cart/update',
    method: 'post',
    data: $(this).serialize(),
    success: function(data) {
      console.log(data);
      var price = $('.price_'+data.product_id).val();
      var amount = data.amount;
      var price_all = price*amount;
      $('.price_all_display_'+data.product_id).text(price_all);
      $('.price_all_'+data.product_id).val(price_all);

      var items = $('input[name^=\"price_all\"]');
      var price_total = 0;
      items.each(function() {
        price_total += parseInt($(this).val());
      });
      $('.price_total').text(price_total);
    }
  });
});
";
?>
