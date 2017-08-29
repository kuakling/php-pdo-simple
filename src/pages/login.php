<?php
$app['pageTitle'] = "เข้าสู่ระบบ";
$app['layout'] = __DIR__ . '/../layouts/blank.php';
$app['cssScripts'][] = "
body{
  background-color: #eee;
}
.form-signup {
  max-width: 500px;
  padding: 15px;
  margin: 0 auto;
}
";

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
<div class="card form-signup">
  <div class="card-body">
    <h4 class="card-title">Login</h4>
    <h6 class="card-subtitle mb-2 text-muted">เข้าสู่ระบบ</h6>
    <div class="card-text">
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
    </div>
    <hr />
    <a href="index.php" class="card-link">Home</a>
    <a href="?page=signup" class="card-link">Signup</a>
  </div>
</div>
