<?php
$limit = 6;
$p = (isset($_GET['p'])) ? intval($_GET['p']) : 1;
$offset = ($p-1)*$limit;
$search = (isset($_GET['search'])) ? $_GET['search'] : null;
$keyword = $search;
$field = (isset($_GET['field'])) ? $_GET['field'] : null;
$operator = (isset($_GET['operator'])) ? $_GET['operator'] : null;

$sql['columns'] = " product.*, product_type.type_name";
$sql['table'] = " FROM product
  INNER JOIN product_type ON product.type_id = product_type.id";
if($search && $operator){
  if($operator === 'LIKE') { $search = "%{$search}%"; }
  if(empty($field)){
    $where = " WHERE name $operator :keyword OR
    product_detail $operator :keyword OR
    price $operator :keyword OR
    size $operator :keyword OR
    type_name $operator :keyword";
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

<nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand" href="?page=product/index"><?= $app['pageTitle']; ?></a>
  <form class="form-inline" method="get">
    <input type="hidden" name="page" value="product/index">
    <div class="form-group">
      <select id="field" name="field" class="form-control">
        <option value=""> -- All --</option>
        <option value="name"<?= ($field == 'name') ? ' selected' : '' ?>>Name</option>
        <option value="product_detail"<?= ($field == 'product_detail') ? ' selected' : '' ?>>Detail</option>
        <option value="price"<?= ($field == 'price') ? ' selected' : '' ?>>Price</option>
        <option value="size"<?= ($field == 'size') ? ' selected' : '' ?>>Size</option>
        <option value="type_name"<?= ($field == 'type_name') ? ' selected' : '' ?>>Type</option>
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
</nav>

<div class="row">
  <?php
  foreach ($result as $product) {
    include(__DIR__ . '/_item.php');
  }
  ?>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item<?= ($p == 1) ? ' disabled' : '' ?>">
      <a class="page-link" href="?page=product/index&p=<?= $p-1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php for($i=1; $i<=$pageCount; $i++) : ?>
    <li class="page-item<?= ($p == $i) ? ' active' : '' ?>"><a class="page-link" href="?page=product/index&p=<?= $i; ?>"><?= $i; ?></a></li>
    <?php endfor; ?>
    <li class="page-item<?= ($p >= $pageCount) ? ' disabled' : '' ?>">
      <a class="page-link" href="?page=product/index&p=<?= $p+1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
