<!doctype html>
<html class="no-js" lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Watch shop | Ecommerce</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Ends -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="./"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>                                                
                                <ul id="navigation">  
                                    <li><a href="./">Home</a></li>
                                    <li><a href="shop.php">shop</a></li>
                                    <li><a href="about.php">about</a></li>
                                    <li class="hot"><a href="latest.php">Latest</a>
                                    </li>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                    <?php
                                        if(isset($_SESSION['user']) && isset($_SESSION['id']))
                                        {
                                    ?>   
                                            <li><a href="functions/logout.php">Logout</a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <li>
                                    <div class="nav-search search-switch">
                                        <span class="flaticon-search"></span>
                                    </div>
                                </li>
                                <?php
                                    if(isset($_SESSION['user']) && isset($_SESSION['id']))
                                    {
                                ?>
                                        <li>
                                            <a href="cart.php"><span class="flaticon-shopping-cart">
                                                <sup style="color: red">
                                                    <?php
                                                        if (isset($_SESSION['cart']) && $_SESSION['cart'] > 0)
                                                        {
                                                            echo count($_SESSION['cart']);
                                                        }
                                                        else
                                                        {
                                                            echo 0;
                                                        }
                                                    ?>
                                                 </sup>
                                             </span>
                                         </a> 
                                     </li>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <li> <a href="login.php"><span class="flaticon-user"></span></a></li>
                                        <li>
                                            <a href="login.php">
                                                <span class="flaticon-shopping-cart">
                                                    <sup style="color: red">0</sup>
                                                 </span>
                                             </a> 
                                         </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
