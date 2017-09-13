<?php user_init(); ?>
<?php
if($_POST) {
  $sth = $app['db']->prepare("SELECT * FROM user WHERE id=:id");
  $sth->execute([
    'id' => $_SESSION['auth']['user']['id']
  ]);
  $result = $sth->fetch(PDO::FETCH_ASSOC);
  if (password_verify($_POST['current_password'], $result['password'])) {
    if($_POST['new_password'] && $_POST['new_password'] == $_POST['confirm_password']) {
      // echo 'Password ใหม่ เหมือนกัน';
      $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      ];
      $password_hash = password_hash($_POST['new_password'], PASSWORD_BCRYPT, $options);
      $sql_update = "UPDATE user SET password = :password WHERE id = :id";
      $sth_update = $app['db']->prepare($sql_update);
      $sth_update->execute([
        'password' => $password_hash,
        'id' => $_SESSION['auth']['user']['id']
      ]);

      $_SESSION['auth'] = [
        'isAuthenticated' => false
      ];
      header('location: ./');
    }else{
      add_flash_message('danger', 'การยืนยันรหัสผ่านไม่ถูกต้อง');
    }
  }else{
    add_flash_message('danger', 'พาสเวิร์ดเดิมไม่ถูกต้อง');
  }
}
?>
<form method="post">
  <div class="form-group">
    <label for="current_password">Current Password</label>
    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
  </div>
  <hr />
  <div class="form-group">
    <label for="new_password">New Password</label>
    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
  </div>
  <div class="form-group">
    <label for="current_password">Confirm Password</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
  </div>

  <button type="submit" class="btn btn-primary">
    <i class="fa fa-check" aria-hidden="true"></i>
    Update
  </button>
</form>
