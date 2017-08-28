<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
    $dbh->exec("SET CHARACTER SET UTF8");
    return $dbh;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
