<?php user_init(); ?>
<?php
$sth = $app['db']->prepare("SELECT user_profile.*, user.* FROM user_profile INNER JOIN user ON user_profile.id = user.id WHERE user_profile.id=:id");
$sth->execute([
  'id' => $_SESSION['auth']['user']['id']
]);
$result = $sth->fetch(PDO::FETCH_ASSOC);
?>
<?php
if($_POST) {
  $sql_update = "UPDATE user_profile SET fullname = :fullname, address = :address, gender = :gender, tel = :tel WHERE id = :id";
  $sth_update = $app['db']->prepare($sql_update);
  $sth_update->execute([
    'fullname' => $_POST['fullname'],
    'address' => $_POST['address'],
    'gender' => $_POST['gender'],
    'tel' => $_POST['tel'],
    'id' => $_SESSION['auth']['user']['id']
  ]);

  header("location: ?page=user/index");
  exit();
}
?>
<form method="post">
  <div class="form-group">
    <label for="email">E-Mail</label>
    <input type="text" class="form-control" value="<?=$result['email']?>" disabled>
  </div>
  <div class="form-group">
    <label for="fullname">Full Name</label>
    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" value="<?=$result['fullname']?>">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=$result['address']?>">
  </div>
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="gender" id="gender_1" value="1"<?=($result['gender'] == 1) ? ' checked' : ''?>>
      <i class="fa fa-male" aria-hidden="true"></i> Male
    </label>
  </div>
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="gender" id="gender_2" value="2"<?=($result['gender'] == 2) ? ' checked' : ''?>>
      <i class="fa fa-female" aria-hidden="true"></i> Female
    </label>
  </div>
  <div class="form-group">
    <label for="tel">Tel.</label>
    <input type="text" class="form-control" id="tel" name="tel" placeholder="Tel." value="<?=$result['tel']?>">
  </div>
  <button type="submit" class="btn btn-primary">
    <i class="fa fa-check" aria-hidden="true"></i>
    Update
  </button>
</form>
