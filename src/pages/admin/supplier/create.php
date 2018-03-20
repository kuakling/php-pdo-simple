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
    $stmt = $app['db']->prepare("INSERT INTO supplier (supplier_name, address, telephone, detail) VALUES (:supplier_name, :address, :telephone, :detail)");
    $stmt->execute([
      'supplier_name' => $_POST['supplier_name'],
      'address' => $_POST['address'],
      'telephone' => $_POST['telephone'],
      'detail' => $_POST['detail'],
    ]);

    $errorInfo = $stmt->errorInfo();
    if($errorInfo[2]){
      add_flash_message('warning', $errorInfo[2]);
    }else{
      header('location: ?page=admin/supplier/index');
      exit();
    }
  }

}

$app['pageTitle'] = "เพิ่มข้อมูลร้านคู่ค้า";

$formData = [
  'supplier_name' => @$_POST['supplier_name'],
  'address' => @$_POST['address'],
  'telephone' => @$_POST['telephone'],
  'detail' => @$_POST['detail']
];
?>
<h2><?= $app['pageTitle']; ?></h2>

<?php include(__DIR__ . '/_form.php');
