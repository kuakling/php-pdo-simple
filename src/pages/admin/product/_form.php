<form method="post">
  <div class="form-group">
    <label for="name">ชื่อร้านคู่ค้า</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['name'])){ echo " is-invalid";}?>"
      id="name"
      name="name"
      placeholder="ชื่อร้านคู่ค้า"
      value="<?= $formData['name']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['name'])){ echo $errors['name'];}?></div>
  </div>

  <div class="form-group">
    <label for="product_detail">ที่อยู่</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['product_detail'])){ echo " is-invalid";}?>"
      id="product_detail"
      name="product_detail"
      placeholder="ที่อยู่"
      value="<?= $formData['product_detail']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['product_detail'])){ echo $errors['product_detail'];}?></div>
  </div>

  <div class="form-group">
    <label for="price">หมายเลขโทรศัพท์</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['price'])){ echo " is-invalid";}?>"
      id="price"
      name="price"
      placeholder="หมายเลขโทรศัพท์"
      value="<?= $formData['price']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['price'])){ echo $errors['price'];}?></div>
  </div>

  <div class="form-group">
    <label for="qty">รายละเอียด</label>
    <textarea
      class="form-control"
      id="qty"
      name="qty"
      rows="5"
    ><?= $formData['qty']; ?></textarea>
  </div>

  <div class="form-group">
    <label for="size">ชื่อร้านคู่ค้า</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['size'])){ echo " is-invalid";}?>"
      id="size"
      name="size"
      placeholder="ชื่อร้านคู่ค้า"
      value="<?= $formData['size']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['size'])){ echo $errors['size'];}?></div>
  </div>

  <div class="form-group">
    <label for="type_id">ที่อยู่</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['type_id'])){ echo " is-invalid";}?>"
      id="type_id"
      name="type_id"
      placeholder="ที่อยู่"
      value="<?= $formData['type_id']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['type_id'])){ echo $errors['type_id'];}?></div>
  </div>

  <div class="form-group">
    <label for="image">หมายเลขโทรศัพท์</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['image'])){ echo " is-invalid";}?>"
      id="image"
      name="image"
      placeholder="หมายเลขโทรศัพท์"
      value="<?= $formData['image']; ?>"
    />
    <div class="invalid-feedback"><?php if(isset($errors['image'])){ echo $errors['image'];}?></div>
  </div>

  <div class="form-group">
    <label for="supplier_id">รายละเอียด</label>
    <textarea
      class="form-control"
      id="supplier_id"
      name="supplier_id"
      rows="5"
    ><?= $formData['supplier_id']; ?></textarea>
    <div class="invalid-feedback"><?php if(isset($errors['supplier_id'])){ echo $errors['supplier_id'];}?></div>
  </div>



  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
