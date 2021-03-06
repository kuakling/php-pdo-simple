<?php
user_init();
$app['layout'] = __DIR__ . '/../../layouts/main.php';
?>
<?php
$sth_user = $app['db']->prepare("SELECT user_profile.*, user.* FROM user_profile INNER JOIN user ON user_profile.id = user.id WHERE user_profile.id=:id");
$sth_user->execute([
  'id' => $_SESSION['auth']['user']['id']
]);
$result_user = $sth_user->fetch(PDO::FETCH_ASSOC);
?>
<form method="post" action="?page=cart/confirm">
  <div class="row">
    <div class="container-fluid">
      <div class="text-center">
        <img src="assets/images/logo.svg" width="100" class="pull-left">
        <h3>อ่าวไทยเครื่องเขียน</h3>
        123 ถ.เจริญประดิษฐ์ ต.รูสะมิแล<br />อ.เมือง จ.ปัตตานี 94000
      </div>
      <hr />
      <div class="">
        <h4>ผู้ซื้อ</h4>
        <div class="">
          ชื่อ: <?= $result_user['fullname']; ?>
        </div>
        <div class="">
          <div class="form-group">
            <label for="send_address">ที่อยู่: </label>
            <input type="text" class="form-control" id="send_address" name="send_address" value="<?= $result_user['address']; ?>">
          </div>
        </div>
        <div class="">
          หมายเลขโทรศัพท์: <?= $result_user['tel']; ?>
        </div>
        <div class="">
          อีเมล์: <?= $result_user['email']; ?>
        </div>
      </div>
    </div>
  </div>


  <table class="table table-striped border">
    <thead class="thead-inverse">
      <tr>
        <th>#</th>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th class="text-right">ราคา/หน่วย</th>
        <th class="text-right" style="width: 130px;">จำนวน</th>
        <th class="text-right">ราคารวม</th>
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
        <td class="text-right"><?= number_format($product['price']); ?></td>
        <td class="text-right">
          <?= $item['amount']; ?>
        </td>
        <td class="text-right"><?= number_format($price_all); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot class="table-warning" style="font-weight: bold;">
      <tr>
        <td colspan="5" class="text-right">ราคาสุทธิ</td>
        <td class="text-right price_total"><?=number_format($price_total)?></td>
      </tr>
    </tfoot>
  </table>

  <div class="text-right">
    <!-- <a href="?page=cart/confirm" class="btn btn-primary">
      <i class="fa fa-check"></i>
      ยืนยันการสั่งซื้อ
    </a> -->
    <button type="submit" class="btn btn-primary">
      <i class="fa fa-check" aria-hidden="true"></i>
      ยืนยันการสั่งซื้อ
    </button>
  </div>
</form>
