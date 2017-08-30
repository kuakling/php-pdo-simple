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
// echo $rowCount;

$pageCount = ceil($rowCount/$limit);
// echo $pageCount;

$app['pageTitle'] = "สินค้า";
?>

<h2><?= $app['pageTitle']; ?></h2>
<a href="?page=admin/product/create" class="btn btn-success">
  <i class="fa fa-plus" aria-hidden="true"></i>
  เพิ่มข้อมูล
</a>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 100px;">ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Type</th>
      <th style="width: 80px;" class="text-center">Action</th>
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
        <a href="?page=admin/product/view&id=<?= $row['id'] ?>" class="text-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
        <a href="?page=admin/product/update&id=<?= $row['id'] ?>" class="text-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a href="?page=admin/product/delete&id=<?= $row['id'] ?>" class="text-danger btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item<?= ($p == 1) ? ' disabled' : '' ?>">
      <a class="page-link" href="?page=admin/product/index&p=<?= $p-1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php for($i=1; $i<=$pageCount; $i++) : ?>
    <li class="page-item<?= ($p == $i) ? ' active' : '' ?>"><a class="page-link" href="?page=admin/product/index&p=<?= $i; ?>"><?= $i; ?></a></li>
    <?php endfor; ?>
    <li class="page-item<?= ($p >= $pageCount) ? ' disabled' : '' ?>">
      <a class="page-link" href="?page=admin/product/index&p=<?= $p+1; ?>" aria-label="Next">
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
