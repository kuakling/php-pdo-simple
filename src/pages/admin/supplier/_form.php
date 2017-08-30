<form method="post">
  <div class="form-group">
    <label for="supplier_name">ชื่อร้านคู่ค้า</label>
    <input
      type="text"
      class="form-control<?php if(isset($errors['supplier_name'])){ echo " is-invalid";}?>"
      id="supplier_name"
      name="supplier_name"
      placeholder="ชื่อร้านคู่ค้า"
      value="<?= $formData['supplier_name']; ?>"
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
      value="<?= $formData['address']; ?>"
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
      value="<?= $formData['telephone']; ?>"
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
    ><?= $formData['detail']; ?></textarea>
  </div>



  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
