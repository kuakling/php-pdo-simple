<?php admin_init(); ?>
<?php
$app['pageTitle'] = "สินค้า";
$app['layout'] = __DIR__ . '/../../../layouts/pdf.php';
$mpdfArgs = ['th', 'A4'];
$mpdfSettings = [
  'SetWatermarkText' => $app['pageTitle'],
  'showWatermarkText' => true,
];
?>
<?php
$sql = "SELECT product.*, product_type.type_name, supplier.supplier_name FROM product
  INNER JOIN product_type ON product.type_id = product_type.id
  INNER JOIN supplier ON product.supplier_id = supplier.id";

$sth = $app['db']->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
// echo $pageCount;
?>

<style>
  @page :first {
    header: html_firstpage;
    margin-top: 50mm;
  }
  @page {
    header: html_otherpages;
    margin-top: 27mm;
  }
  @page {
    footer: html_pagefooter1;
  }
</style>
<!-- กำหนดหัวกระดาษของหน้าแรก (หน้าแรกให้มีชื่อร้าน) -->
<htmlpageheader name="firstpage" style="display:none">
  <table class="table">
    <tr>
      <td width="50%" style="color:#0000BB; ">
        <span style="font-weight: bold; font-size: 14pt;">อ่าวไทยเครื่องเขียน</span><br />
        123 ถ.เจริญประดิษฐ์ ต.รูสะมิแล<br />อ.เมือง จ.ปัตตานี 94000
      </td>
      <td width="50%" style="text-align: right;">
        <span style="font-family:dejavusanscondensed;">&#9742;</span> 073-123456<br />
        Facebook: aothai<br />
        Line ID: aothai
      </td>
    </tr>
  </table>
  <div class="summary">
    รายการสินค้าทั้งหมดจำนวน <?= $sth->rowCount() ?>
  </div>
  <hr />
</htmlpageheader>


<!-- กำหนดหัวกระดาษของหน้าอื่นๆ ที่ไม่ใช่หน้าแรก (หน้า 2 เป็นต้นไป) -->
<htmlpageheader name="otherpages" style="display:none">
  <div class="summary">
    <table width="100%">
      <tr>
        <td width="50%" style="font-weight:bold">อ่าวไทยเครื่องเขียน</td>
        <td style="text-align:right">รายการสินค้าทั้งหมดจำนวน <?= $sth->rowCount() ?></td>
      </tr>
    </table>
  </div>
  <hr />
</htmlpageheader>


<!-- กำหนดท้ายกระดาษ -->
<htmlpagefooter name="pagefooter1" style="display:none">
  <table width="100%" style="vertical-align: bottom; font-weight: bold; font-style: italic;">
    <tr>
      <td width="33%"><?=$app['pageTitle']?></td><!-- แสดง pageTitle อยู่ด้านซ้าย -->
      <td align="center">{DATE j-m-Y}</td><!-- แสดงวันที่ปัจจุบัน(วันที่สั่งพริ้น) อยู่ตรงกลาง -->
      <td width="33%" style="text-align: right;">Page {PAGENO} of {nbpg}</td><!-- แสดง หน้าปัจจุบัน of จำนวนหน้าทั้งหมด อยู่ด้านขวา -->
    </tr>
  </table>
</htmlpagefooter>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 50px;">ID</th>
      <th>Name</th>
      <th class="text-right">Price</th>
      <th class="text-right">Qty</th>
      <th>Type</th>
      <th>Sullpier</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
      <th scope="row"><?= $row['id']; ?></th>
      <td><?= $row['name']; ?></td>
      <td class="text-right"><?= number_format($row['price']); ?></td>
      <td class="text-right"><?= number_format($row['qty']); ?></td>
      <td><?= $row['type_name']; ?></td>
      <td><?= $row['supplier_name']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
