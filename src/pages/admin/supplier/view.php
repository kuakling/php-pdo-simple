<?php admin_init(); ?>
<?php
$sth = $app['db']->prepare("SELECT * FROM supplier WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);
$result = $sth->fetch(PDO::FETCH_ASSOC);
$app['pageTitle'] = "ดูข้อมูลร้านคู่ค้า: ".$result['supplier_name'];
?>
<h2><?= $app['pageTitle'] ?></h2>
<a href="?page=admin/supplier/index" class="btn btn-dark">รายการทั้งหมด</a>
<a href="?page=admin/supplier/create" class="btn btn-success">เพิ่ม</a>
<a href="?page=admin/supplier/update&id=<?= $result['id'] ?>" class="btn btn-primary">แก้ไข</a>
<a href="?page=admin/supplier/delete&id=<?= $result['id'] ?>" class="btn btn-danger btn-delete">ลบ</a>
<table class="table">
  <tbody>
    <tr>
      <th style="width: 200px;">Name</th>
      <td><?= $result['supplier_name'] ?></td>
    </tr>
    <tr>
      <th>Address</th>
      <td><?= $result['address'] ?></td>
    </tr>
    <tr>
      <th>Telephone</th>
      <td><?= $result['telephone'] ?></td>
    </tr>
    <tr>
      <th>Detail</th>
      <td><?= $result['detail'] ?></td>
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
