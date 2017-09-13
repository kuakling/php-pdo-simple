<?php user_init(); ?>
<?php

$sth_orders = $app['db']->prepare("SELECT orders.*, user.*, user_profile.*, orders.id as id FROM orders
  INNER JOIN user ON orders.user_id = user.id
  INNER JOIN user_profile ON user.id = user_profile.id
  WHERE orders.id=:id AND orders.user_id=:user_id");
$sth_orders->execute([
  'id' => $_GET['id'],
  'user_id' => $_SESSION['auth']['user']['id']
]);
$result_orders = $sth_orders->fetch(PDO::FETCH_ASSOC);
?>
<?php if($result_orders) {
  $app['layout'] = __DIR__ . '/../../layouts/pdf.php';
?>
  <table style="width: 100%">
    <tr>
      <td style="width:80px;">
        <img src="assets/images/logo.svg" style="width: 80px;">
      </td>
      <td style="text-align:center;">
        <h3>อ่าวไทยเครื่องเขียน</h3>
        123 ถ.เจริญประดิษฐ์ ต.รูสะมิแล<br />อ.เมือง จ.ปัตตานี 94000
      </td>
    </tr>
  </table>
  <hr />
  <table style="width: 100%; line-height: 1.7;">
    <tr>
      <td style="width: 50%">
        <h4>ผู้ซื้อ</h4>
        <div class="">
          ชื่อ: <?= $result_orders['fullname']; ?>
        </div>
        <div class="">
          ที่อยู่: <?= $result_orders['address']; ?>
        </div>
        <div class="">
          ส่ง: <?= $result_orders['send_address']; ?>
        </div>
        <div class="">
          หมายเลขโทรศัพท์: <?= $result_orders['tel']; ?>
        </div>
        <div class="">
          อีเมล์: <?= $result_orders['email']; ?>
        </div>
      </td>
      <td style="text-align: right; vertical-align: top;">
        <div class="">
          รหัสการสั่งซื้อ: <?= sprintf("%05s", $result_orders['id']); ?>
        </div>
        <div class="">
          วันที่สั่งซื้อ: <?= date('d/m/Y h:i:s', strtotime($result_orders['date'])) ?>
        </div>
        <?php
        $statuses = cart_stateses();
        ?>
        <div class="">
          สถานะ: <?= $statuses[intval($result_orders['status'])] ?>
        </div>
      </td>
    </tr>
  </table>
<div class="row">
  <div class="container-fluid">
    <div class="pull-right text-right">

    </div>
    <div class="">

    </div>
  </div>
</div>



<?php
$sth_items = $app['db']->prepare("SELECT orders_items.*, product.name as pname FROM orders_items
  INNER JOIN product ON orders_items.product_id = product.id
  WHERE orders_id=:orders_id");
$sth_items->execute([
  'orders_id' => $result_orders['id'],
]);
$result_items = $sth_items->fetchAll(PDO::FETCH_ASSOC);
// print_r($result_items);
?>
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
    $i = 0;
    $price_total = 0;
    foreach ($result_items as $item) :
      $i++;
    ?>
    <?php
    $price_all = $item['price'] * $item['amount'];
    $price_total += $price_all;
    ?>
    <tr>
      <th scope="row"><?= $i ?></th>
      <td><?= $item['id']; ?></td>
      <td><?= $item['pname']; ?></td>
      <td class="text-right"><?= number_format($item['price']); ?></td>
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

<?php }else{
  add_flash_message('danger', 'ไม่มีการสั่งซื้อสินค้าในรหัสนี้');
}
?>
