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

$errors = [];
if($_POST) {
  if($_POST['username'] == "") {
    $errors['username'] = 'กรุณาระบุ Username';
  }
  if($_POST['password'] == "") {
    $errors['password'] = 'กรุณาระบุ Password';
  }

  if($errors){
    //กรณีมี Error
  }else{
    $sth = $app['db']->prepare("SELECT * FROM user WHERE username = :username");
    $sth->execute([
      'username' => $_POST['username']
    ]);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if($result){
      if (password_verify($_POST['password'], $result['password'])) {
        if($result['status'] == 1) {
          $_SESSION['auth'] = [
            'isAuthenticated' => true,
            'user' => [
              'id' => $result['id'],
              'username' => $result['username'],
              'email' => $result['email'],
              'status' => $result['status'],
              'is_admin' => intval($result['is_admin']),
              'created_at' => $result['created_at'],
              'updated_at' => $result['updated_at'],
            ],
          ];
          $url = './';
          if(isset($_SESSION['url_back'])){
            $url = $_SESSION['url_back'];
            unset($_SESSION['url_back']);
          }
          header("location: {$url}");
          exit();
        }else{
          $app['flashMessages'][] = [
            'type' => 'danger',
            'text' => 'User ของคุณถูกระงับ !!!'
          ];
        }
      } else {
        echo 'No Invalid password.';
      }
    }else{
      echo 'No user';
    }
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
          <label for="username">Username</label>
          <input type="text" class="form-control<?php if(isset($errors['username'])){ echo " is-invalid";}?>" id="username" name="username" placeholder="Username">
          <div class="invalid-feedback"><?php if(isset($errors['username'])){ echo $errors['username'];}?></div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control<?php if(isset($errors['password'])){ echo " is-invalid";}?>" id="password" name="password" placeholder="Password">
          <div class="invalid-feedback"><?php if(isset($errors['password'])){ echo $errors['password'];}?></div>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-sign-in" aria-hidden="true"></i>
          Login
        </button>
      </form>
    </div>
    <hr />
    <a href="index.php" class="card-link"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    <a href="?page=signup" class="card-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Signup</a>
  </div>
</div>
