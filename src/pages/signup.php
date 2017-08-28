<h1 class="test">Signup</h1>
<?php
$app['pageTitle'] = "ลงทะเบียน";

$sth = $app['db']->prepare("SELECT * FROM user");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
print_r($result);

 ?>
