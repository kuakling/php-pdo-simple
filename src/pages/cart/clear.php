<?php
unset($_SESSION['cart']);
// $_SESSION['cart'] = [];

header("location: ?page=cart/index");
?>
