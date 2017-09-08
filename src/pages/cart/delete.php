<?php
unset($_SESSION['cart'][$_GET['id']]);

header("location: ?page=cart/index");
?>
