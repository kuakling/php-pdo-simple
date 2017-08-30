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
      $app['flashMessages'][] = [
        'type' => 'warning',
        'text' => $errorInfo[2]
      ];
    }else{
      header('location: ?page=admin/supplier/index');
      exit();
    }
  }

}

$app['pageTitle'] = "เพิ่มข้อมูลร้านคู่ค้า";
?>
<h2><?= $app['pageTitle']; ?></h2>
<form method="post">
  <div class="form-group">
    <label for="supplier_name">ชื่อร้านคู่ค้า</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['supplier_name'])){ echo " is-invalid";}?>"
      id="supplier_name"
      name="supplier_name"
      placeholder="ชื่อร้านคู่ค้า"
    />
    <div class="invalid-feedback"><?php if(isset($errors['supplier_name'])){ echo $errors['supplier_name'];}?></div>
  </div>

  <div class="form-group">
    <label for="address">ที่อยู่</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['address'])){ echo " is-invalid";}?>"
      id="address"
      name="address"
      placeholder="ที่อยู่"
    />
    <div class="invalid-feedback"><?php if(isset($errors['address'])){ echo $errors['address'];}?></div>
  </div>

  <div class="form-group">
    <label for="telephone">หมายเลขโทรศัพท์</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['telephone'])){ echo " is-invalid";}?>"
      id="telephone"
      name="telephone"
      placeholder="หมายเลขโทรศัพท์"
    />
    <div class="invalid-feedback"><?php if(isset($errors['telephone'])){ echo $errors['telephone'];}?></div>
  </div>

  <div class="form-group">
    <label for="detail">รายละเอียด</label>
    <textarea
      class="form-control"
      id="detail"
      name="detail"
      rows="5"
    ></textarea>
  </div>



  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
