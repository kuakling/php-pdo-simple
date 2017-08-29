<?php
$app['pageTitle'] = "ลงทะเบียน";
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

// $sth = $app['db']->prepare("SELECT * FROM user");
// $sth->execute();
// $result = $sth->fetch(PDO::FETCH_ASSOC);
// print_r($result);
if($_POST) {
  $options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
  ];
  $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
  $stmt = $app['db']->prepare("INSERT INTO user (username, password, email, status, created_at, updated_at) VALUES (:username, :password, :email, :status, :created_at, :updated_at)");
  $stmt->execute([
    'username' => $_POST['username'],
    'password' => $password_hash,
    'email' => $_POST['email'],
    'status' => 1,
    'created_at' => date('Y-m-d h:i:s'),
    'updated_at' => date('Y-m-d h:i:s'),
  ]);

  $errorInfo = $stmt->errorInfo();
  if($errorInfo[2]){
    $app['flashMessages'][] = [
      'type' => 'warning',
      'text' => $errorInfo[2]
    ];
  }else{
    header('location: index.php');
  }
}

 ?>

 <div class="card form-signup">
   <div class="card-body">
     <h4 class="card-title">Signup</h4>
     <h6 class="card-subtitle mb-2 text-muted">สมัครสมาชิก</h6>
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
         <div class="form-group">
           <label for="email">e-Mail</label>
           <input type="text" class="form-control" id="email" name="email" placeholder="e-Mail">
         </div>
         <button type="submit" class="btn btn-primary">Signup</button>
         <br />
       </form>
     </div>
     <hr />
     <a href="index.php" class="card-link">Home</a>
     <a href="?page=login" class="card-link">Login</a>
   </div>
 </div>
