<?php

session_start();

include_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

$limit = 9;

if (isset($_GET['page']))
{
  $page = trim($_GET['page']);
}
else
{
  $page = 1;
}

$start_from = ($page-1) * $limit;

$statement = "SELECT * FROM products ORDER BY created_at DESC LIMIT $start_from, $limit";
$products = $database->Read($statement);

?>

<?php
require_once('top.inc.php');
?>

<main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Watch Shop</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!-- Latest Products Start -->
        <section class="popular-items latest-padding">
            <div class="container">
                <div class="row product-btn justify-content-between mb-40">
                    <div class="properties__button">
                        <!--Nav Button  -->
                        <nav>                                                      
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">NewestArrivals</a>
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                    <!-- Grid and List view -->
                    <div class="grid-list-view">
                    </div>
                    <!-- Select items -->
                    <!--
                    <div class="select-this">
                        <form action="latest.html" id="pl" method="POST">
                            <div class="select-itms">
                                <select name="page_limit" id="select1" onselect="$('#pl').submit()">
                                    <option value="6">6 per page</option>
                                    <option selected="selected" value="9">9 per page</option>
                                    <option value="12">12 per page</option>
                                    <option value="15">15 per page</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    -->
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <?php
                                if ($products)
                                {
                                    foreach ($products as $product)
                                    {
                            ?>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                            <div class="single-popular-items mb-50 text-center">
                                                <div class="popular-img">
                                                    <img src="assets/img/gallery/<?php echo $product['image']; ?>" alt="">
                                                    <a href="
                                                        <?php
                                                            if(isset($_SESSION['user']) && isset($_SESSION['id']))
                                                            {
                                                                echo "update-cart.php?action=add&id=" . $product['id'] . "";
                                                            }
                                                            else
                                                            {
                                                                echo "login.php";
                                                            }
                                                        ?>
                                                    ">
                                                        <div class="img-cap">
                                                            <span>Add to cart</span>
                                                        </div>
                                                    </a>
                                                    <div class="favorit-items">
                                                        <span class="flaticon-heart"></span>
                                                    </div>
                                                </div>
                                                <div class="popular-caption">
                                                    <h3><a href="product_details.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h3>
                                                    <span>$ <?php echo number_format($product["price"]); ?></span>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End Nav Card -->
                
                <div>
                    <?php
                        $result_db = "SELECT COUNT(id) FROM products";
                        $row_db = $database->Read($result_db);
                        $total_records = $row_db[0]['COUNT(id)'];
                        $total_pages = ceil($total_records / $limit);
                        $pagLink = "";
                        for ($i = 1; $i <= $total_pages; $i++)
                        {
                            if ($i == $page)
                            $pagLink .= "<a class='btn view-btn1' style='margin-right:20px; background-color: grey; color: red;' href='latest.php?page=" . $i . "'>" . $i . "  </a>";
                            else
                            {                            
                                $pagLink .= "<a class='btn view-btn1' style='margin-right:20px' href='latest.php?page=" . $i . "'>" . $i . "  </a>";
                            }
                        }
                        echo $pagLink;
                    ?>
                </div>
            </div>
        </section>
        <!-- Latest Products End -->
        <!--? Shop Method Start-->
        <div class="shop-method-area">
            <div class="container">
                <div class="method-wrapper">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-package"></i>
                                <h6>Free Shipping Method</h6>
                                <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-unlock"></i>
                                <h6>Secure Payment System</h6>
                                <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-reload"></i>
                                <h6>Secure Payment System</h6>
                                <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Asorem ipsum adipolor sdit amet, consectetur adipisicing elitcf sed do eiusmod tem.</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#"> Offers & Discounts</a></li>
                                    <li><a href="#"> Get Coupon</a></li>
                                    <li><a href="#">  Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>New Products</h4>
                                <ul>
                                    <li><a href="#">Woman Cloth</a></li>
                                    <li><a href="#">Fashion Accessories</a></li>
                                    <li><a href="#"> Man Accessories</a></li>
                                    <li><a href="#"> Rubber made Toys</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <li><a href="#">Frequently Asked Questions</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Report a Payment Issue</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer bottom -->
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-8 col-md-7">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> and developed by <a href="http://jofedo.netlify.app" target="_blank">Idowu Joseph</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>                 
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 col-md-5">
                        <div class="footer-copy-right f-right">
                            <!-- social -->
                            <div class="footer-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-behance"></i></a>
                                <a href=""><i class="fas fa-globe"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!--? Search model Begin -->
    <div class="search-model-box">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-btn">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Searching key.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

<!-- JS here -->
    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scroll up, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    
    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    
</body>
</html>