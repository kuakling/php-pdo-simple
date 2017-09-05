<?php admin_init(); ?>
<?php
$limit = 5;
$p = (isset($_GET['p'])) ? intval($_GET['p']) : 1;
$offset = ($p-1)*$limit;
$search = (isset($_GET['search'])) ? $_GET['search'] : null;
$keyword = $search;
$field = (isset($_GET['field'])) ? $_GET['field'] : null;
$operator = (isset($_GET['operator'])) ? $_GET['operator'] : null;

$sql['columns'] = " product.*, product_type.type_name, supplier.supplier_name";
$sql['table'] = " FROM product
  INNER JOIN product_type ON product.type_id = product_type.id
  INNER JOIN supplier ON product.supplier_id = supplier.id";
if($search && $operator){
  if($operator === 'LIKE') { $search = "%{$search}%"; }
  if(empty($field)){
    $where = " WHERE name $operator :keyword OR
    product_detail $operator :keyword OR
    price $operator :keyword OR
    qty $operator :keyword OR
    size $operator :keyword OR
    type_name $operator :keyword OR
    supplier_name $operator :keyword";
  }else{
    $where = " WHERE {$field} {$operator} :keyword";
  }
  $sql['table'] .= $where;
}
$sql['page'] = " LIMIT $limit OFFSET $offset";




$prepare['page'] = "SELECT" . $sql['columns'] . $sql['table'] . $sql['page'];
// echo $prepare['page'];
//SELECT product.*, product_type.type_name FROM product INNER JOIN product_type ON product.type_id = product_type.id LIMIT 5 OFFSET 0

$prepare['count'] = "SELECT count(*) as count" . $sql['table'];
// SELECT count(*) as count FROM product INNER JOIN product_type ON product.type_id = product_type.id

$sth['page'] = $app['db']->prepare($prepare['page']);
$sth['page']->execute(['keyword' => $search]);
$result = $sth['page']->fetchAll(PDO::FETCH_ASSOC);

$sth['count'] = $app['db']->prepare($prepare['count']);
$sth['count']->execute(['keyword' => $search]);
$rowCount = $sth['count']->fetch(PDO::FETCH_ASSOC)['count'];
// echo $rowCount;

$pageCount = ceil($rowCount/$limit);
// echo $pageCount;

$app['pageTitle'] = "สินค้า";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="?page=admin/product/index"><?= $app['pageTitle']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-success" href="?page=admin/product/create">
          <i class="fa fa-plus" aria-hidden="true"></i>
          เพิ่มข้อมูล <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-info" href="?page=admin/product/print">
          <i class="fa fa-print" aria-hidden="true"></i>
          พิมพ์
        </a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="get">
      <input type="hidden" name="page" value="admin/product/index">
      <div class="form-group">
        <select id="field" name="field" class="form-control">
          <option value=""> -- All --</option>
          <option value="name"<?= ($field == 'name') ? ' selected' : '' ?>>Name</option>
          <option value="product_detail"<?= ($field == 'product_detail') ? ' selected' : '' ?>>Detail</option>
          <option value="price"<?= ($field == 'price') ? ' selected' : '' ?>>Price</option>
          <option value="qty"<?= ($field == 'qty') ? ' selected' : '' ?>>Qty</option>
          <option value="size"<?= ($field == 'size') ? ' selected' : '' ?>>Size</option>
          <option value="type_name"<?= ($field == 'type_name') ? ' selected' : '' ?>>Type</option>
          <option value="supplier_name"<?= ($field == 'supplier_name') ? ' selected' : '' ?>>Supplier</option>
        </select>
      </div>
      <div class="form-group">
        <select id="operator" name="operator" class="form-control">
          <?php foreach (sql_operators() as $cmd => $display) : ?>
          <option value="<?= $cmd ?>"<?= ($operator == $cmd) ? ' selected' : '' ?>><?= $display; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="input-group mb-2 mb-sm-0">
        <input type="text" class="form-control" id="search" name="search" placeholder="Search" value="<?= $keyword; ?>">
        <button class="btn btn-outline-success my-2 my-sm-0 input-group-addon" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </div>
    </form>
  </div>
</nav>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 100px;">ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Type</th>
      <th>Sullpier</th>
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
      <td><?= $row['supplier_name']; ?></td>
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
