<?php admin_init(); ?>

<?php
$sth = $app['db']->prepare("DELETE FROM product_type WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);

header('location: ?page=admin/product_type/index');
exit();

?>
