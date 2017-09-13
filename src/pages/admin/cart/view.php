<?php admin_init(); ?>
<?php
if($_POST) {
  try {
    $app['db']->beginTransaction();
    $sth_status = $app['db']->prepare("UPDATE orders SET status=:status WHERE id=:id");
    $sth_status->execute([
      'status' => $_POST['status'],
      'id' => $_GET['id'],
    ]);

    if($_POST['del_product']){
      $sth_items_update = $app['db']->prepare("SELECT * FROM orders_items
        WHERE orders_id=:orders_id");
      $sth_items_update->execute([
        'orders_id' => $_GET['id'],
      ]);
      $result_items_update = $sth_items_update->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result_items_update as $item_update) {
        $sql_product_update = "UPDATE product set qty = qty - :qty WHERE id = :product_id";
        $sth_product_update = $app['db']->prepare($sql_product_update);
        $sth_product_update->execute([
          'qty' => $item_update['amount'],
          'product_id' => $item_update['product_id']
        ]);
      }
    }
    $app['db']->commit();
    header("location: ?page=admin/cart/view&id={$_GET['id']}");
    exit();
  }catch(PDOExecption $e) {
    $app['db']->rollback();
    add_flash_message('warning', $e->getMessage());
  }
}
?>
<?php
$sth_orders = $app['db']->prepare("SELECT orders.*, user.*, user_profile.*, orders.id as id, orders.status as status FROM orders
  INNER JOIN user ON orders.user_id = user.id
  INNER JOIN user_profile ON user.id = user_profile.id
  WHERE orders.id=:id");
$sth_orders->execute([
  'id' => $_GET['id'],
]);
$result_orders = $sth_orders->fetch(PDO::FETCH_ASSOC);
?>
  <div class="row">
    <div class="container-fluid">
      <div class="text-center">
        <img src="assets/images/logo.svg" width="100" class="pull-left">
        <h3>อ่าวไทยเครื่องเขียน</h3>
        123 ถ.เจริญประดิษฐ์ ต.รูสะมิแล<br />อ.เมือง จ.ปัตตานี 94000
      </div>
      <hr />
      <div class="pull-right text-right">
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
          <form method="post" class="form-inline">
            <div class="form-group">
              <label for="status">สถานะ: </label>
              <select class="form-control" id="status" name="status">
                <?php foreach ($statuses as $key => $st) : ?>
                <option value="<?=$key?>"<?= (intval($result_orders['status']) == $key) ? ' selected' : '' ?>><?=$st?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="status_option" style="display: none;">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="del_product" id="del_product">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">ลบจำนวนสินค้าในคลังสินค้า</span>
              </label>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <div class="">
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
        <td><?= $item['product_id']; ?></td>
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
  <div class="text-right">
    <a href="?page=user/cart-history-print&id=<?=$result_orders['id']?>" class="btn btn-outline-secondary" target="_blank">
      <i class="fa fa-print" aria-hidden="true"></i>
      Print
    </a>
  </div>


<?php
$app['jsScripts'][] = "
$('#status').change(function(){
  var status = $(this).val();
  if(status == 2) {
    $('.status_option').show('slow');
  }else{
    $('.status_option').hide('slow');
  }
});
";
?>
