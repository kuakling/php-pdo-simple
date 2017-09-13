<?php admin_init(); ?>
<?php
if($_POST){
  $sql_toggle = "UPDATE user SET status=:status, is_admin=:is_admin WHERE id=:id";
  $sth_toggle = $app['db']->prepare($sql_toggle);
  $sth_toggle->execute([
    'status' => (isset($_POST['status'])) ? 1 : 0,
    'is_admin' => (isset($_POST['is_admin'])) ? 1 : 0,
    'id' => $_GET['id']
  ]);
  header("location: ?page=admin/user/toggle-active&id={$_GET['id']}");
  exit();
}
?>
<?php
$sql_user = "SELECT * FROM user INNER JOIN user_profile ON user.id=user_profile.id WHERE user.id=:id";
$sth_user = $app['db']->prepare($sql_user);
$sth_user->execute([
  'id' => $_GET['id']
]);
$result = $sth_user->fetch(PDO::FETCH_ASSOC);
// print_r($result);
?>

<form method="post">
  <div class="form-group">
    <label>Fullname</label>
    <input type="text" class="form-control" value="<?=$result['fullname']?>" disabled>
  </div>

  <div class="form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="status" value="1"<?= ($result['status'] == 1) ? ' checked' : '' ?>>
      Active
    </label>
  </div>
  <div class="form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="is_admin" value="1"<?= ($result['is_admin'] == 1) ? ' checked' : '' ?>>
      Is Admin
    </label>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Save</button>
</form>
