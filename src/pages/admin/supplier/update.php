<?php admin_init(); ?>
<?php
$errors = [];
if($_POST) {
  if($_POST['supplier_name'] == "") {
    $errors['supplier_name'] = 'กรุณาระบุ ชื่อประเภทสินค้า';
  }
  if($_POST['address'] == "") {
    $errors['address'] = 'กรุณาระบุ ที่อยู่';
  }
  if($_POST['telephone'] == "") {
    $errors['telephone'] = 'กรุณาระบุ หมายเลขโทรศัพท์';
  }

  if(!$errors){
    $stmt = $app['db']->prepare("UPDATE supplier SET supplier_name=:supplier_name, address=:address, telephone=:telephone, detail=:detail WHERE id=:id");
    $stmt->execute([
      'supplier_name' => $_POST['supplier_name'],
      'address' => $_POST['address'],
      'telephone' => $_POST['telephone'],
      'detail' => $_POST['detail'],
      'id' => $_GET['id'],
    ]);

    $errorInfo = $stmt->errorInfo();
    if($errorInfo[2]){
      add_flash_message('warning', $errorInfo[2]);
    }else{
      header('location: ?page=admin/supplier/update&id='.$_GET['id']);
      exit();
    }
  }

}

$sth = $app['db']->prepare("SELECT * FROM supplier WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);
$formData = array_merge($sth->fetch(PDO::FETCH_ASSOC), $_POST);
$app['pageTitle'] = "แก้ไขข้อมูลร้านคู่ค้า: ".$formData['supplier_name'];
?>
<h2><?= $app['pageTitle']; ?></h2>

<?php include(__DIR__ . '/_form.php');
