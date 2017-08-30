<?php admin_init(); ?>

<?php
$sth = $app['db']->prepare("DELETE FROM supplier WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);

header('location: ?page=admin/supplier/index');
exit();

?>
