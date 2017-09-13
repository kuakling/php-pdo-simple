<?php admin_init(); ?>
<?php
$errors = [];
if($_POST) {
  if($_POST['type_name'] == "") {
    $errors['type_name'] = 'กรุณาระบุ ชื่อประเภทสินค้า';
  }

  if(!$errors){
    $stmt = $app['db']->prepare("INSERT INTO product_type (type_name) VALUES (:type_name)");
    $stmt->execute([
      'type_name' => $_POST['type_name'],
    ]);

    $errorInfo = $stmt->errorInfo();
    if($errorInfo[2]){
      add_flash_message('warning', $errorInfo[2]);
    }else{
      header('location: ?page=admin/product_type/index');
      exit();
    }
  }

}

$app['pageTitle'] = "เพิ่มข้อมูลประเภทสินค้า";
?>
<h2><?= $app['pageTitle']; ?></h2>
<form method="post">
  <div class="form-group">
    <label for="type_name">ชื่อประเภทสินค้า</label>
    <input type="text" class="form-control<?php if(isset($errors['type_name'])){ echo " is-invalid";}?>" id="type_name" name="type_name" placeholder="ชื่อประเภทสินค้า">
    <div class="invalid-feedback"><?php if(isset($errors['type_name'])){ echo $errors['type_name'];}?></div>
  </div>
  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
