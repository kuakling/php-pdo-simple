<?php layout_begin_page(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $app['pageTitle']; ?></title>

    <!-- Google Fonts -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'> -->

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php layout_head(); ?>
  </head>
  <body>

    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['isAuthenticated']){ ?>
                        <li>
                          <a href="?page=user/index">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <?php echo $_SESSION['auth']['user']['username']; ?>
                          </a>
                        </li>
                        <?php if(intval($_SESSION['auth']['user']['is_admin'])){ ?>
                        <li>
                          <a href="?page=admin/index">
                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                            Admin
                          </a>
                        </li>
                        <?php } ?>
                        <li>
                          <a href="?page=logout">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Logout
                          </a>
                        </li>
                        <?php } else { ?>
                        <li>
                          <a href="?page=signup">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Signup
                          </a>
                        </li>
                        <li>
                          <a href="?page=login">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            Login
                          </a>
                        </li>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="header-right">
                        <h5 class="text-secondary text-right" style="padding: 10px; margin: 0;">currency : THB ฿</h5>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1>
                            <a href="./">
                                <img src="assets/images/logo.svg" style="width: 50px;">
                                อ่าวไทยเครื่องเขียน
                            </a>
                        </h1>
                    </div>
                </div>

                <div class="col-sm-6">
                    <?php
                    $total_price = 0;
                    $cart_count = 0;
                    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        $cart_count = count($_SESSION['cart']);
                        foreach ($_SESSION['cart'] as $key => $cart) {
                            $cart_item_price = $cart['amount'] * $cart['price'];
                            $total_price += $cart_item_price;
                        }
                    }
                    ?>
                    <div class="shopping-item">
                        <a href="?page=cart/index">
                            Cart - <span class="cart-amunt"><?=number_format($total_price)?> ฿</span> <i class="fa fa-shopping-cart"></i>
                            <span class="product-count"><?= $cart_count ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 0; width: 100%;">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin: auto;">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item<?= (!isset($_GET['page'])) ? ' active' : '' ?>">
                          <a class="nav-link" href="./">
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
                      </ul>
                  </div>
                </nav>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <?php if(!isset($_GET['page'])) { ?>
    <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">
					<li>
						<img src="assets/images/slider/slider-01.jpg" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								<span class="primary"> <strong>อ่าวไทยเครื่องเขียน</strong></span> ยินดีต้อนรับ
							</h2>
							<h4 class="caption subtitle">โทร. 073123456</h4>
							<a class="caption button-radius" href="?page=product/index"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="assets/images/slider/h4-slide2.png" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								by one, get one <span class="primary">50% <strong>off</strong></span>
							</h2>
							<h4 class="caption subtitle">school supplies & backpacks.*</h4>
							<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="assets/images/slider/slider-03.jpg" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								สีเทียนตราช้าง <span class="primary">ลดทั้งร้าน <strong>50%</strong></span>
							</h2>
							<h4 class="caption subtitle">Select Item</h4>
							<a class="caption button-radius" href="?page=product/view&id=4"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="assets/images/slider/h4-slide4.png" alt="Slide">
						<div class="caption-group">
						  <h2 class="caption title">
								Apple <span class="primary">Store <strong>Ipod</strong></span>
							</h2>
							<h4 class="caption subtitle">& Phone</h4>
							<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
						</div>
					</li>
				</ul>
			</div>
			<!-- ./Slider -->
    </div> <!-- End slider area -->
    <?php } ?>

    <div class="promo-area">

    </div> <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                  <?php
                  $sth_product_type = $app['db']->prepare("SELECT * FROM product_type");
                  $sth_product_type->execute();
                  $result_product_type = $sth_product_type->fetchAll(PDO::FETCH_ASSOC);
                  ?>
                  <div class="list-group">
                    <a href="./" class="list-group-item<?= (!isset($_GET['page'])) ? ' active' : '' ?>">
                      หน้าแรก
                    </a>
                    <a href="?page=product/index" class="list-group-item<?= (isset($_GET['page']) && $_GET['page'] == 'product/index') ? ' active' : '' ?>">
                      สินค้าทั้งหมด
                    </a>
                    <?php foreach ($result_product_type as $row) : ?>
                    <a href="?page=product/index&product_type=<?=$row['id']?>" class="list-group-item<?= (isset($_GET['product_type']) && $_GET['product_type'] == $row['id']) ? ' active' : '' ?>">
                      <?= $row['type_name']; ?>
                    </a>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="col-md-9">
                  <?php layout_flash_messages(); ?>
                  <?php echo $app['content']; ?>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <?php /*
    <div class="brands-area">

    </div> <!-- End brands area -->

    <div class="product-widget-area">

    </div> <!-- End product widget area -->
    */ ?>

    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>อ่าวไทย</span>เครื่องเขียน</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="?page=user/profile">My account</a></li>
                            <li><a href="?page=user/index">Order history</a></li>
                            <li><a href="./">Home page</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="?page=product/index">สินค้าทั้งหมด</a></li>
                            <li><a href="?page=product/index&product_type=1">สมุด</a></li>
                            <li><a href="?page=product/index&product_type=2">แฟ้ม</a></li>
                            <li><a href="?page=product/index&product_type=3">อุปกรณ์สำนักงาน</a></li>
                            <li><a href="?page=product/index&product_type=4">อุปกรณ์กีฬา</a></li>
                            <li><a href="?page=product/index&product_type=5">ปากกา</a></li>
                            <li><a href="?page=product/index&product_type=6">ดินสอ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="Type your email">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->

    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->

    <!-- Latest jQuery form server -->
    <script src="assets/js/jquery-3.2.1.min.js" ></script>
    <script src="assets/js/popper.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="assets/js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="assets/js/main.js"></script>

    <?php if(!isset($_GET['page'])) { ?>
    <!-- Slider -->
    <script type="text/javascript" src="assets/js/bxslider.min.js"></script>
	<script type="text/javascript" src="assets/js/script.slider.js"></script>
    <?php } ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <?php layout_end_body(); ?>
  </body>
</html>
