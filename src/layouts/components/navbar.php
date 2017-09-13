<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">
    <img src="assets/images/logo.svg" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item<?= (!isset($_GET['page'])) ? ' active' : '' ?>">
        <a class="nav-link" href="index.php">
          <i class="fa fa-home" aria-hidden="true"></i>
          Home <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item<?= (isset($_GET['page']) && $_GET['page'] == 'product/index') ? ' active' : '' ?>">
        <a class="nav-link" href="?page=product/index">
          <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          Product
        </a>
      </li>
      <li class="nav-item<?= (isset($_GET['page']) && $_GET['page'] == 'cart/index') ? ' active' : '' ?>">
        <a class="nav-link" href="?page=cart/index">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          Cart
          <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
          <span class="badge badge-pill badge-danger"><?= count($_SESSION['cart']) ?></span>
          <?php } ?>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav  my-2 my-lg-0">
      <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['isAuthenticated']){ ?>
      <li class="nav-item">
        <a class="nav-link" href="?page=user/index">
          <i class="fa fa-user" aria-hidden="true"></i>
          <?php echo $_SESSION['auth']['user']['username']; ?>
        </a>
      </li>
      <?php if(intval($_SESSION['auth']['user']['is_admin'])){ ?>
      <li class="nav-item">
        <a class="nav-link" href="?page=admin/index">
          <i class="fa fa-user" aria-hidden="true"></i>
          Admin
        </a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="?page=logout">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
          Logout
        </a>
      </li>
      <?php } else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?page=signup">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          Signup
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=login">
          <i class="fa fa-sign-in" aria-hidden="true"></i>
          Login
        </a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>
