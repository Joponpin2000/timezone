<?php

session_start();

include_once("functions/DatabaseClass.php");

if(!isset($_SESSION['user']) && !isset($_SESSION['id']))
{
    header("location: login.php");
    exit;
}

$database = new DatabaseClass();

/*$cart_total = 0;

if(isset($_GET['action']))
{
  switch ($_GET['action'])
  {
    case "remove":
      if (!empty($_SESSION['cart_item']))
      {
          foreach($_SESSION['cart_item'] as $k => $v)
          {
              if (isset($_GET['code']) && $_GET['code'] == $k)
              {
                  unset($_SESSION['cart_item'][$k]);
              }
              if (empty($_SESSION['cart_item']))
              {
                  unset($_SESSION['cart_item']);
              }
          }
      }
      break;

    case 'empty':
      unset($_SESSION["cart_item"]);
      break;

  }
}

if (isset($_POST['submit']))
{
    if (!empty(trim($_POST['quantity'])) && is_numeric($_POST['quantity']))
    {
        $code = trim($_POST['code']);
        echo '1';
        if ($_POST['quantity'] > 0)
        {
            if (in_array($code, array_keys($_SESSION['cart'])))
            {
                foreach ($_SESSION['cart'] as $k => $v)
                {
                    if ($code == $k)
                    {
                        if (empty($_SESSION['cart'][$k]['quantity']))
                        {
                            $_SESSION['cart'][$k]['quantity'] = 0;
                        }
                        $_SESSION['cart'][$k]['quantity'] = $_POST['quantity'];
                    }
                }
            }    
        }
        else
        {
            echo '1';

            if (in_array($code, array_keys($_SESSION['cart'])))
            {
                echo '1';

                foreach ($_SESSION['cart'] as $k => $v)
                {
                    echo '1';

                    if ($code == $k)
                    {
                        echo '1';
                        unset($_SESSION['cart'][$code]);   
                    }
                }
            }    
        }
    }
}*/

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
                              <h2>Cart List</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!--================Cart Area =================-->

      <?php
        if(isset($_SESSION['cart']))
        {
          $total = 0;
          $total_quantity = 0;
          $total_price = 0;
      ?>
      <section class="cart_area section_padding">
        <div class="container">
          <div class="cart_inner">
            <div class="table-responsive">
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($_SESSION['cart'] as $product_id => $quantity)
                    {
                      $product = $database->Read("SELECT * FROM products WHERE id = :id", ['id' => $product_id]);

                      $cost = $product[0]['price'] * $quantity; //work out the line cost
                      $total = $total + $cost; //add to the total cost
                  ?>
                      <tr>
                        <td>
                          <div class="media">
                            <div class="d-flex">
                              <img src="assets/img/gallery/<?php echo $product[0]['image']; ?>" alt="product image" />
                            </div>
                            <div class="media-body">
                              <p><?php echo $product[0]['name']; ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <h5>$<?php echo number_format($product[0]['price']); ?></h5>
                        </td>
                        <form method="POST" action="<?php echo
                            htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <td>
                                <div class="product_count">
                                    <input class="input-number" type="text" name="quantity" value="<?php echo $quantity ?>" min="0" max="10" /><br />
                                </div>
                            </td>
                            <td>
                                <h5>$<?php echo number_format(0000000); ?></h5>
                            </td>
                            <td>
                                <h5>
                                <span class="btn_1">
                                        <input type="hidden" name="code" value="<?php echo $product[0]['id']; ?>" />
                                        <input type="submit" name="submit" style="background-color: transparent; border: none; color: inherit" value="UPDATE CART" />
                                    </span>
                                    <a href="update-cart.php?action=remove&id=<?php echo $product[0]['id']; ?>" class="btnRemoveAction">
                                        <i class="fa fa-trash" style="color: red; margin: 0 10px;"></i>
                                    </a>
                                </h5>
                            </td>
                        </form>
                      </tr>
                  <?php
                        $total_quantity +=$quantity;
                        $total_price += ($product[0]['price'] * $quantity);
                    }
                  ?>     
                    <tr class="bottom_button">
                      <td>
                        <div class="cupon_text float-right">
                            <a href="update-cart.php?action=empty" class="btn_1" >Empty Cart</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>
                        <h5>Subtotal</h5>
                      </td>
                      <td>
                        <h5>$<?php echo number_format($total_price); ?></h5>
                      </td>
                    </tr>
                    <tr class="shipping_area">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="shipping_box">
                          <ul class="list">
                            <li>
                              Flat Rate: $5.00
                              <input type="radio" aria-label="Radio button for following text input">
                            </li>
                            <li>
                              Free Shipping
                              <input type="radio" aria-label="Radio button for following text input">
                            </li>
                            <li>
                              Flat Rate: $10.00
                              <input type="radio" aria-label="Radio button for following text input">
                            </li>
                            <li class="active">
                              Local Delivery: $2.00
                              <input type="radio" aria-label="Radio button for following text input">
                            </li>
                          </ul>
                          <h6>
                            Calculate Shipping
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                          </h6>
                          <select class="shipping_select">
                            <option value="1">Bangladesh</option>
                            <option value="2">India</option>
                            <option value="4">Pakistan</option>
                          </select>
                          <select class="shipping_select section_bg">
                            <option value="1">Select a State</option>
                            <option value="2">Select a State</option>
                            <option value="4">Select a State</option>
                          </select>
                          <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                          <a class="btn_1" href="#">Update Details</a>
                        </div>
                      </td>
                    </tr>
                </tbody>
              </table>
              <div class="checkout_btn_inner float-right">
                <a class="btn_1" href="shop.php">Continue Shopping</a>
                <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
              </div>
            </div>
          </div>
      </section>
      <!--================End Cart Area =================-->
  </main>
  <?php
    }
        else
        {
    ?>
            <div class="container" style="margin-top: 50px; height: 20vh;">
                <div class="row">
                  <div class="col-md-12" style="margin-bottom: 50px;">
                    <h3 style="opacity: 0.5;">Your Cart is empty!</h3>
                  </div>
                  <div class="col-md-12">
                    <a class="btn_1" href="shop.php">Continue Shopping</a>
                  </div>
                </div>
            </div>
    <?php
        }
    ?>
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
                              <a href="#"><i class="fab fa-twitter"></i></a>
                              <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                              <a href="#"><i class="fab fa-behance"></i></a>
                              <a href="#"><i class="fas fa-globe"></i></a>
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
  
  <!-- Scrollup, nice-select, sticky -->
  <script src="./assets/js/jquery.scrollUp.min.js"></script>
  <script src="./assets/js/jquery.nice-select.min.js"></script>
  <script src="./assets/js/jquery.sticky.js"></script>
  <script src="./assets/js/jquery.magnific-popup.js"></script>

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