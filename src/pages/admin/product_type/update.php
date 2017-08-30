<?php admin_init(); ?>
<?php
$errors = [];
if($_POST) {
  if($_POST['type_name'] == "") {
    $errors['type_name'] = 'กรุณาระบุ ชื่อประเภทสินค้า';
  }

  if(!$errors){
    $stmt = $app['db']->prepare("UPDATE product_type SET type_name = :type_name WHERE id = :id");
    $stmt->execute([
      'type_name' => $_POST['type_name'],
      'id' => $_GET['id']
    ]);

    $errorInfo = $stmt->errorInfo();
    if($errorInfo[2]){
      $app['flashMessages'][] = [
        'type' => 'warning',
        'text' => $errorInfo[2]
      ];
    }else{
      header('location: ?page=admin/product_type/update&id='.$_GET['id']);
      exit();
    }
  }

}
?>
<?php
$sth = $app['db']->prepare("SELECT * FROM product_type WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);
$result = $sth->fetch(PDO::FETCH_ASSOC);

$app['pageTitle'] = "แก้ไขข้อมูลประเภทสินค้า: {$result['type_name']}";
?>
<h2><?= $app['pageTitle']; ?></h2>
<form method="post">
  <div class="form-group">
    <label for="type_name">ชื่อประเภทสินค้า</label>
    <input type="text"
      class="form-control<?php if(isset($errors['type_name'])){ echo " is-invalid";}?>"
      id="type_name"
      name="type_name"
      placeholder="ชื่อประเภทสินค้า"
      value="<?= $result['type_name'] ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['type_name'])){ echo $errors['type_name'];}?></div>
  </div>
  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
