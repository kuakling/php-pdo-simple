<?php
$app['pageTitle'] = "เข้าสู่ระบบ";

if ($_POST) {
  $sth = $app['db']->prepare("SELECT * FROM user WHERE username = :username");
  $sth->execute([
    'username' => $_POST['username']
  ]);
  $result = $sth->fetch(PDO::FETCH_ASSOC);
  if($result){
    if (password_verify($_POST['password'], $result['password'])) {
      $_SESSION['auth'] = [
        'isAuthenticated' => true,
        'user' => [
          'id' => $result['id'],
          'username' => $result['username'],
          'email' => $result['email'],
          'status' => $result['status'],
          'created_at' => $result['created_at'],
          'updated_at' => $result['updated_at'],
        ],
      ];
      header('location: index.php');
    } else {
      echo 'No Invalid password.';
    }
  }else{
    echo 'No user';
  }
}
?>

<h1>Login</h1>

<form method="post">
  <div class="form-group">
    <label for="usernam">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
