<?php
/*******เมื่อต้องการแก้ไขข้อมูลแบบ AJAX ******/
// $app['layout'] = __DIR__ . '/../../layouts/json.php';
// $sess_key = key($_POST['amount']);
// // echo $sess_key;
// $_SESSION['cart'][$sess_key]['amount'] = intval($_POST['amount'][$sess_key]);
//
//
// $arr = [
//   'product_id' => $sess_key,
//   'amount' => $_SESSION['cart'][$sess_key]['amount'],
// ];
//
// echo json_encode($arr);
?>

<?php
/*******เมื่อต้องการแก้ไขข้อมูลแบบ POST ******/
$product_id = key($_POST['amount']);
$_SESSION['cart'][$product_id]['amount'] = intval($_POST['amount'][$product_id]);

add_flash_message('success', 'เปลี่ยนแปลงจำนวนสินค้าเรียบร้อย');

header("location: ?page=cart/index");
exit();
?>
