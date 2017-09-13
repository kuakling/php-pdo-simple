<?php admin_init(); ?>
<?php
$sql_user = "SELECT * FROM user INNER JOIN user_profile ON user.id=user_profile.id";
$sth_user = $app['db']->prepare($sql_user);
$sth_user->execute();
$result = $sth_user->fetchAll(PDO::FETCH_ASSOC);
?>
<table class="table table-striped border">
  <thead>
    <tr>
      <th>ID</th>
      <th>Fullname</th>
      <th>E-Mail</th>
      <th>Address</th>
      <th>Gender</th>
      <th>Tel</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $user) : ?>
    <tr>
      <th><?=$user['id']?></th>
      <td><?=$user['fullname']?></td>
      <td><?=$user['email']?></td>
      <td><?=$user['address']?></td>
      <td><?= ($user['gender'] == 1) ? 'Male' : 'Female'; ?></td>
      <td><?=$user['tel']?></td>
      <td><?= ($user['status'] == 1) ? 'Active' : 'Not Active'; ?></td>
      <td><a href="?page=admin/user/toggle-active&id=<?=$user['id']?>">SET</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
