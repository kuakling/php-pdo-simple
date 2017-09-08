<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>รหัสสินค้า</th>
      <th>ชื่อสินค้า</th>
      <th>ราคา/หน่วย</th>
      <th>จำนวน</th>
      <th>ราคารวม</th>
      <th>...</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    foreach ($_SESSION['cart'] as $product_id => $item) :
      $i++;
    ?>
    <tr>
      <th scope="row"><?= $i ?></th>
      <td><?= $product_id; ?></td>
      <td>Otto</td>
      <td>@mdo</td>
      <td><?= $item['amount']; ?></td>
      <td>Otto</td>
      <td><a href="#" class="text-danger"><i class="fa fa-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
