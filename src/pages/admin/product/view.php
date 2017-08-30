<?php admin_init(); ?>
<?php
$sth = $app['db']->prepare("SELECT * FROM product WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);
$result = $sth->fetch(PDO::FETCH_ASSOC);
$app['pageTitle'] = "ดูข้อมูลสินค้า: ".$result['name'];
?>
<h2><?= $app['pageTitle'] ?></h2>
<a href="?page=admin/product/index" class="btn btn-dark">รายการทั้งหมด</a>
<a href="?page=admin/product/create" class="btn btn-success">เพิ่ม</a>
<a href="?page=admin/product/update&id=<?= $result['id'] ?>" class="btn btn-primary">แก้ไข</a>
<a href="?page=admin/product/delete&id=<?= $result['id'] ?>" class="btn btn-danger btn-delete">ลบ</a>
<table class="table">
  <tbody>
    <tr>
      <th style="width: 200px;">Name</th>
      <td><?= $result['name'] ?></td>
    </tr>
    <tr>
      <th>Detail</th>
      <td><?= $result['product_detail'] ?></td>
    </tr>
    <tr>
      <th>Price</th>
      <td><?= $result['price'] ?></td>
    </tr>
    <tr>
      <th>Qty</th>
      <td><?= $result['qty'] ?></td>
    </tr>
    <tr>
      <th>Size</th>
      <td><?= $result['size'] ?></td>
    </tr>
    <tr>
      <th>Type</th>
      <td><?= $result['type_id'] ?></td>
    </tr>
    <tr>
      <th>Image</th>
      <td><?= $result['image'] ?></td>
    </tr>
    <tr>
      <th>Supplier</th>
      <td><?= $result['supplier_id'] ?></td>
    </tr>
  </tbody>
</table>


<?php
$app['jsScripts'][] = "
$('.btn-delete').click(function(){
  if(!confirm('กรุณายืนยันการลบข้อมูล')) { return false; }
});
";
?>
