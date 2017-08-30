<?php admin_init(); ?>
<?php
$sth = $app['db']->prepare("SELECT * FROM product");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$app['pageTitle'] = "สินค้า";
?>

<h2><?= $app['pageTitle']; ?></h2>
<a href="?page=admin/product/create" class="btn btn-success">เพิ่มข้อมูล</a>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 100px;">ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Type</th>
      <th style="width: 150px;" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
      <th scope="row"><?= $row['id']; ?></th>
      <td><?= $row['name']; ?></td>
      <td><?= $row['price']; ?></td>
      <td><?= $row['qty']; ?></td>
      <td><?= $row['type_id']; ?></td>
      <td class="text-center">
        <a href="?page=admin/product/view&id=<?= $row['id'] ?>" class="btn btn-info btn-sm">ดู</a>
        <a href="?page=admin/product/update&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">แก้ไข</a>
        <a href="?page=admin/product/delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm btn-delete">ลบ</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
$app['jsScripts'][] = "
$('.btn-delete').click(function(){
  if(!confirm('กรุณายืนยันการลบข้อมูล')) { return false; }
});
";
?>
