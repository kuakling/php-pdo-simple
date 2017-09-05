<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">ชื่อสินค้า</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['name'])){ echo " is-invalid";}?>"
      id="name"
      name="name"
      placeholder="ชื่อสินค้า"
      value="<?= $formData['name']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['name'])){ echo $errors['name'];}?></div>
  </div>

  <div class="form-group">
    <label for="product_detail">รายละเอียด</label>
    <textarea
      class="form-control"
      id="product_detail"
      name="product_detail"
      rows="5"
    ><?= $formData['product_detail']; ?></textarea>
  </div>

  <div class="form-group">
    <label for="price">ราคาขาย</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['price'])){ echo " is-invalid";}?>"
      id="price"
      name="price"
      placeholder="ราคาขาย"
      value="<?= $formData['price']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['price'])){ echo $errors['price'];}?></div>
  </div>

  <div class="form-group">
    <label for="qty">จำนวนคงเหลือ</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['qty'])){ echo " is-invalid";}?>"
      id="qty"
      name="qty"
      placeholder="จำนวนคงเหลือ"
      value="<?= $formData['qty']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['qty'])){ echo $errors['qty'];}?></div>
  </div>

  <div class="form-group">
    <label for="size">ขนาด</label>
    <input
      type="text"
      class="form-control"
      id="size"
      name="size"
      placeholder="ขนาด"
      value="<?= $formData['size']; ?>"
    />
  </div>

  <?php
  $sth = $app['db']->prepare("SELECT * FROM product_type");
  $sth->execute();
  $result_product_types = $sth->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <div class="form-group">
    <label for="type_id">ประเภทสินค้า</label>
    <select
      class="form-control<?php if(isset($errors['type_id'])){ echo " is-invalid";}?>"
      id="type_id"
      name="type_id"
    >
      <?php foreach ($result_product_types as $product_type) : ?>
      <option value="<?= $product_type['id'] ?>"><?= $product_type['type_name'] ?></option>
      <?php endforeach; ?>
    </select>
    <div class="invalid-feedback"><?php if(isset($errors['type_id'])){ echo $errors['type_id'];}?></div>
  </div>

  <div class="form-group">
    <label for="image">ภาพ</label>
    <input
      type="file"
      class="form-control-file"
      id="image"
      name="image"
    />
  </div>

  <?php
  $sth = $app['db']->prepare("SELECT * FROM supplier");
  $sth->execute();
  $result_suppliers = $sth->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <div class="form-group">
    <label for="supplier_id">ร้านคู่ค้า</label>
    <select
      class="form-control<?php if(isset($errors['supplier_id'])){ echo " is-invalid";}?>"
      id="supplier_id"
      name="supplier_id"
    >
      <?php foreach ($result_suppliers as $supplier) : ?>
      <option value="<?= $supplier['id'] ?>"><?= $supplier['supplier_name'] ?></option>
      <?php endforeach; ?>
    </select>
    <div class="invalid-feedback"><?php if(isset($errors['supplier_id'])){ echo $errors['supplier_id'];}?></div>
  </div>



  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
