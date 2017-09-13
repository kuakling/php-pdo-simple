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

$errors = [];
if($_POST) {
  if($_POST['username'] == "") {
    $errors['username'] = 'กรุณาระบุ Username';
  }
  if($_POST['password'] == "") {
    $errors['password'] = 'กรุณาระบุ Password';
  }
  if($_POST['email'] == "") {
    $errors['email'] = 'กรุณาระบุ e-Mail';
  }

  if($errors){

  }else{
    $options = [
      'cost' => 11,
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    try {
      $app['db']->beginTransaction();
      $stmt = $app['db']->prepare("INSERT INTO user (username, password, email, status, is_admin, created_at, updated_at) VALUES (:username, :password, :email, :status, :is_admin, :created_at, :updated_at)");
      $stmt->execute([
        'username' => $_POST['username'],
        'password' => $password_hash,
        'email' => $_POST['email'],
        'status' => 1,
        'is_admin' => 0,
        'created_at' => date('Y-m-d h:i:s'),
        'updated_at' => date('Y-m-d h:i:s'),
      ]);

      $stmt2 = $app['db']->prepare("INSERT INTO user_profile (id, created_at, updated_at) VALUES (:id, :created_at, :updated_at)");
      $stmt2->execute([
        'id' => $app['db']->lastInsertId(),
        'created_at' => date('Y-m-d h:i:s'),
        'updated_at' => date('Y-m-d h:i:s'),
      ]);
      $app['db']->commit();
    }catch(PDOExecption $e) {
      $app['db']->rollback();
      add_flash_message('warning', $e->getMessage());
    }


    $errorInfo = $stmt->errorInfo();
    if($errorInfo[2]){
      add_flash_message('warning', $errorInfo[2]);
    }else{
      header('location: index.php');
    }
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
           <label for="username">Username</label>
           <input type="text" class="form-control<?php if(isset($errors['username'])){ echo " is-invalid";}?>" id="username" name="username" placeholder="Username">
           <div class="invalid-feedback"><?php if(isset($errors['username'])){ echo $errors['username'];}?></div>
         </div>
         <div class="form-group">
           <label for="password">Password</label>
           <input type="password" class="form-control<?php if(isset($errors['password'])){ echo " is-invalid";}?>" id="password" name="password" placeholder="Password">
           <div class="invalid-feedback"><?php if(isset($errors['password'])){ echo $errors['password'];}?></div>
         </div>
         <div class="form-group">
           <label for="email">e-Mail</label>
           <input type="text" class="form-control<?php if(isset($errors['email'])){ echo " is-invalid";}?>" id="email" name="email" placeholder="e-Mail">
           <div class="invalid-feedback"><?php if(isset($errors['email'])){ echo $errors['email'];}?></div>
         </div>
         <button type="submit" class="btn btn-primary">
           <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
           Signup
         </button>
         <br />
       </form>
     </div>
     <hr />
     <a href="index.php" class="card-link"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
     <a href="?page=login" class="card-link"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
   </div>
 </div>
