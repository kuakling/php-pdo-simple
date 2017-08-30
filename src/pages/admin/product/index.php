<?php admin_init(); ?>
<?php
$limit = 5;
$p = (isset($_GET['p'])) ? intval($_GET['p']) : 1;
$offset = ($p-1)*$limit;
$sql['columns'] = " product.*, product_type.type_name";
$sql['table'] = " FROM product INNER JOIN product_type ON product.type_id = product_type.id";
$sql['page'] = " LIMIT $limit OFFSET $offset";

$prepare['page'] = "SELECT" . $sql['columns'] . $sql['table'] . $sql['page'];
//SELECT product.*, product_type.type_name FROM product INNER JOIN product_type ON product.type_id = product_type.id LIMIT 5 OFFSET 0

$prepare['count'] = "SELECT count(*) as count" . $sql['table'];
// SELECT count(*) as count FROM product INNER JOIN product_type ON product.type_id = product_type.id

$sth['page'] = $app['db']->prepare($prepare['page']);
$sth['page']->execute();
$result = $sth['page']->fetchAll(PDO::FETCH_ASSOC);

$sth['count'] = $app['db']->prepare($prepare['count']);
$sth['count']->execute();
$rowCount = $sth['count']->fetch(PDO::FETCH_ASSOC)['count'];
echo $rowCount;

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
      <td><?= $row['type_name']; ?></td>
      <td class="text-center">
        <a href="?page=admin/product/view&id=<?= $row['id'] ?>" class="btn btn-info btn-sm">ดู</a>
        <a href="?page=admin/product/update&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">แก้ไข</a>
        <a href="?page=admin/product/delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm btn-delete">ลบ</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

<?php
$app['jsScripts'][] = "
$('.btn-delete').click(function(){
  if(!confirm('กรุณายืนยันการลบข้อมูล')) { return false; }
});
";
?>
