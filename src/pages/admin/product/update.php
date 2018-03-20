<?php admin_init(); ?>
<?php
$sth = $app['db']->prepare("SELECT * FROM product WHERE id=:id");
$sth->execute([
  'id' => $_GET['id']
]);
$formData = array_merge($sth->fetch(PDO::FETCH_ASSOC), $_POST);

$errors = [];
if($_POST) {
  if($_POST['name'] == "") {
    $errors['name'] = 'กรุณาระบุ ชื่อสินค้า';
  }
  if($_POST['price'] == "") {
    $errors['price'] = 'กรุณาระบุ ราคาสินค้า';
  }
  if($_POST['qty'] == "") {
    $errors['qty'] = 'กรุณาระบุ จำนวนคงเหลือ';
  }
  if($_POST['type_id'] == "") {
    $errors['type_id'] = 'กรุณาระบุ ประเภทสินค้า';
  }
  if($_POST['supplier_id'] == "") {
    $errors['supplier_id'] = 'กรุณาระบุ ร้านคู่ค้า';
  }

  if(!$errors){
    //Upload Product image
    $dbImage = $formData['image'];
    if($_FILES && !$_FILES['image']['error']){
      $dir['base'] = $app['uploadDir'];
      $dir['sub'] = 'product/images';
      $dir['upload'] = $dir['base'] . '/' . $dir['sub'];
      $fileName = time() . '_' . $_FILES['image']['name'];
      if(move_uploaded_file($_FILES['image']['tmp_name'], "{$dir['upload']}/{$fileName}")){
        unlink("{$dir['upload']}/$dbImage");
        $dbImage = $fileName;
      }
    }

    $sql = "UPDATE product SET name=:name,
      product_detail=:product_detail,
      price=:price,
      qty=:qty,
      size=:size,
      type_id=:type_id,
      image=:image,
      supplier_id=:supplier_id
      WHERE id=:id";
    $stmt = $app['db']->prepare($sql);
    $stmt->execute([
      'name' => $_POST['name'],
      'product_detail' => $_POST['product_detail'],
      'price' => $_POST['price'],
      'qty' => $_POST['qty'],
      'size' => $_POST['size'],
      'type_id' => $_POST['type_id'],
      'image' => $dbImage,
      'supplier_id' => $_POST['supplier_id'],
      'id' => $_GET['id']
    ]);

    $errorInfo = $stmt->errorInfo();
    if($errorInfo[2]){
      add_flash_message('warning', $errorInfo[2]);
    }else{
      header('location: ?page=admin/product/update&id='.$_GET['id']);
      exit();
    }
  }

}


$app['pageTitle'] = "แก้ไขข้อมูลสินค้า: ".$formData['name'];
?>
<h2><?= $app['pageTitle']; ?></h2>

<?php include(__DIR__ . '/_form.php');
