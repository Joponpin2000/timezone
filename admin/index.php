<?php
session_start();

require_once("../functions/DatabaseClass.php");

$database = new DatabaseClass();

if(!isset($_SESSION['admin']))
{
	header("location:adminlogin.php");
	
}

?>

<!DOCTYPE html>
<html class="no-js" lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Watch shop | Ecommerce</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="style.css">
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
    
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 style="color: white">Admin Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="product.php">Product</a>
                </li>
                <li>
                    <a href="users.php">Users</a>
                </li>
                <li>
                    <a href="contact_us.php">Contact Us</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <div id="content" style="padding-left: 20px; width: 100vw">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="btn btn-warning" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                </div>
            </nav>
            <div class="title">
                <h3>Dashboard</h3>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <a href="product.php">
                            <div class="service-card btn" style="background: inherit;">
                              <div class="caption">
                                <h4>Products</h4>
                                <p>Manage Products</p>
                              </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <a href="users.php">
                            <div class="service-card btn" style="background: inherit;">
                              <div class="caption">
                                <h4>Users</h4>
                                <p>Manage Users</p>
                              </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <a href="contact_us.php">
                            <div class="service-card btn" style="background: inherit;">
                              <div class="caption">
                                <h4>Messages</h4>
                                <p>Manage Messages</p>
                              </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="copyrights">
                <div class="container">
                    <div class="row" >
                        <div style="margin: 0 auto">
                            <p>All Rights Reserved. &copy; 2020 <b><a href="../" style="color: inherit;">Timezone</a></b> Developed by : <a href="http://jofedo.netlify.app" target="_blank"><b>Idowu Joseph</b></a></p>
                        </div>
                    </div>
                </div><!-- end container -->
            </div><!-- end copyrights -->
        </div>
        
    </div>


    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>


 <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    
    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->    
    <script src="..assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="custom.js"></script>
    
    </body>
</html>