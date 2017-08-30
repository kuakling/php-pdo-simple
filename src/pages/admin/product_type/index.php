<?php admin_init(); ?>

<?php
$sth = $app['db']->prepare("SELECT * FROM product_type");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>ประเภทสินค้า</h2>
<a href="?page=admin/product_type/create" class="btn btn-success">เพิ่มข้อมูล</a>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 100px;">ID</th>
      <th>Name</th>
      <th style="width: 120px;" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
      <th scope="row"><?= $row['id']; ?></th>
      <td><?= $row['type_name']; ?></td>
      <td class="text-center">
        <a href="?page=admin/product_type/update" class="btn btn-primary btn-sm">แก้ไข</a>
        <a href="?page=admin/product_type/delete" class="btn btn-danger btn-sm">ลบ</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
