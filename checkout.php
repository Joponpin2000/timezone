<?php

session_start();

include_once("functions/DatabaseClass.php");

$coupon = false;

$database = new DatabaseClass();

$msg = "";
$name = $firstname = $lastname = $email = $phone = $country = $address = $city = $zip = "";
$firstname_err = $lastname_err = $email_err = $phone_err = $country_err = $address_err = $city_err = $zip_err = "";

if ($_SERVER["REQUEST_METHOD"] =="POST")
{
  if (isset($_POST['coupon_code'])) 
  {
    $coupon_code = '1234asd';
    if ($_POST['coupon_code'] == $coupon_code) 
    {
      $coupon = true;
    }
  }

  if (isset($_POST["pay"])) 
  {
    if (empty(trim($_POST["firstname"])))
    {
        $firstname_err = "Please enter firstname.";
    }
    else {
        $firstname = trim($_POST["firstname"]);
    }

    if (empty(trim($_POST["lastname"])))
    {
        $lastname_err = "Please enter lastname.";
    }
    else {
        $lastname = trim($_POST["lastname"]);
    }

    //validate email
    if (empty(trim($_POST["email"])))
    {
        $email_err = "Please enter email.";
    }
    else {
        //SANITIZE EMAIL
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    }

    if (empty(trim($_POST["phone"])))
    {
        $phone_err = "Please enter phone number.";
    }
    else
    {
      $phone = trim($_POST["phone"]);
    }

    if (empty(trim($_POST["country"])))
    {
        $country_err = "Please choose country.";
    }
    else
    {
      $country = trim($_POST["country"]);
    }

    if(empty(trim($_POST["address"])))
    {
        $address_err = "Please enter address.";
    }
    else {
        $address = trim($_POST["address"]);
    }

    if(empty(trim($_POST["city"])))
    {
        $city_err = "Please enter city.";
    }
    else
    {
        $city = trim($_POST["city"]);
    }

    if(empty(trim($_POST["zip"])))
    {
        $zip_err = "Please enter zip.";
    }
    else
    {
        $zip = trim($_POST["zip"]);
    }

    $notes = trim($_POST["notes"]);

    //Check input errors before inserting in databse
    if((empty($firstname_err) && empty($lastname_err)) 
        && (empty($email_err) && empty($phone_err)) 
        && (empty($country_err) && empty($city_err))
        && (empty($address_err) && empty($zip_err)))
    {
      $amount = trim($_GET['amount']);
      $name = $firstname . ' ' . $lastname; 
      $sql = "INSERT INTO shipping_details (name, email, phone, country, city, address, zip, notes) VALUES (:name, :email, :phone, :country, :city, :address, :zip, :notes)";
      $details = $database->Insert($sql, ['name' => $name, 'email' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 'address' =>$address, 'zip' => $zip, 'notes'=> $notes]);
      header('location: functions/initialize.php?email=' . $email . '&amount=' . $amount);
    }
  }
}

?>
    <?php
        require_once('top.inc.php')
    ?>
   <main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Checkout Area =================-->
    <?php
      if (isset($_SESSION['cart_item']))
      {
        $total_quantity = 0;
        $total_price = 0;
        $flat_rate = 50.00;
        $pay_total = 0
    ?>
      <section class="checkout_area section_padding">
        <div class="container">
          <!--<div class="returning_customer">
            <div class="check_title">
              <h2>
                Returning Customer?
                <a href="#">Click here to login</a>
              </h2>
            </div>
            <p>
              If you have shopped with us before, please enter your details in the
              boxes below. If you are a new customer, please proceed to the
              Billing & Shipping section.
            </p>
            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="name" name="name" value=" " />
                <span class="placeholder" data-placeholder="Username or Email"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="password" class="form-control" id="password" name="password" value="" />
                <span class="placeholder" data-placeholder="Password"></span>
              </div>
              <div class="col-md-12 form-group">
                <button type="submit" value="submit" class="btn_3">
                  log in
                </button>
                <div class="creat_account">
                  <input type="checkbox" id="f-option" name="selector" />
                  <label for="f-option">Remember me</label>
                </div>
                <a class="lost_pass" href="#">Lost your password?</a>
              </div>
            </form>
          </div>-->
            <?php
              if ($coupon == false) {
            ?>
                <div class="cupon_area">
                  <div class="check_title">
                    <h2>
                      Have a coupon?
                      <!--<a href="#">Click here to enter your code</a>-->
                    </h2>
                  </div>
                  <form action="checkout.php" method="POST">
                    <input type="text" class="inp" name="coupon_code" placeholder="Enter coupon code" />
                    <input type="submit" value="Apply Coupon" class="tp_btn" />
                  </form>
                </div>
            <?php
              }
            ?>
          <div class="billing_details">
            <form class="contact_form" action="checkout.php" method="POST">
              <div class="row">
                <div class="col-lg-8">
                  <h3>Billing Details</h3>
                  <div class="row">
                    <div class="col-md-6 form-group p_star">
                      <label>Firstname</label>
                      <input type="text" class="form-control" id="first" name="firstname" value="<?php echo $firstname; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $firstname_err; ?></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                      <label>Lastname</label>
                      <input type="text" class="form-control" id="last" name="lastname" value="<?php echo $lastname; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $lastname_err; ?></span>
                    </div>
                    <!--<div class="col-md-12 form-group">
                      <input type="text" class="form-control" id="company" name="company" placeholder="Company name" />
                    </div>-->
                    <div class="col-md-6 form-group p_star">
                      <label>Phone Number</label>
                      <input type="text" class="form-control" id="number" name="phone" value="<?php echo $phone; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $phone_err; ?></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                      <label>Email Address</label>
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $email_err; ?></span>
                    </div>
                    <div class="col-md-12 form-group p_star">
                      <label>Address</label>
                      <input type="text" class="form-control" id="add1" name="address" value="<?php echo $address; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $address_err; ?></span>
                    </div>
                    <div class="col-md-12 form-group p_star">
                      <label>Town/City</label>
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $city_err; ?></span>
                    </div>
                    <div class="col-md-12 form-group p_star">
                      <!--<select name="country" class="country_select form-control">
                        <option value="Country">Country</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                        <option value="Nigeria">Nigeria</option>
                      </select>-->
                      <label>Country</label>
                      <input type="text" class="form-control" id="country" name="country" value="<?php echo $country; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $country_err; ?></span>
                    </div>

                    <!--<div class="col-md-12 form-group p_star">
                      <select class="country_select">
                        <option value="1">District</option>
                        <option value="2">District</option>
                        <option value="4">District</option>
                      </select>
                    </div>-->
                    <div class="col-md-12 form-group">
                      <label>Post Code/Zip</label>
                      <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $zip; ?>" />
                      <span class="help-block" style="color:red;"><?php echo $zip_err; ?></span>
                    </div>
                    <!--<div class="col-md-12 form-group">
                      <div class="creat_account">
                        <input type="checkbox" id="f-option2" name="selector" />
                        <label for="f-option2">Create an account?</label>
                      </div>
                    </div>-->
                    <div class="col-md-12 form-group">
                      <!--<div class="creat_account">
                        <h3>Shipping Details</h3>
                        <input type="checkbox" id="f-option3" name="selector" />
                        <label for="f-option3">Ship to a different address?</label>
                      </div>-->
                      <label>Order Notes</label>
                      <textarea class="form-control" name="notes" id="message" rows="1"></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="order_box">
                    <h2>Your Order</h2>
                    <ul class="list">
                      <li>
                        <a href="#">Product
                          <span>Total</span>
                        </a>
                      </li>
                      <?php
                        foreach ($_SESSION['cart_item'] as $item)
                        {
                          $item_price = $item["quantity"] * $item["price"];
                      ?>
                        <li>
                          <a href="#"> <?php echo $item["name"] ; ?>
                            <span class="middle">x <?php echo $item["quantity"] ; ?></span>
                            <span class="last">$<?php echo number_format($item_price); ?></span>
                          </a>
                        </li>
                      <?php
                          $total_quantity +=$item["quantity"];
                          $total_price += $item_price;
                        }
                      ?>

                    </ul>
                    <ul class="list list_2">
                      <li>
                        <a href="#">Subtotal
                          <span>$<?php echo number_format($total_price); ?></span>
                        </a>
                      </li>
                      <li>
                        <a href="#">Shipping
                          <span>Flat rate: $<?php echo number_format($flat_rate); ?></span>
                        </a>
                      </li>
                      <li>
                        <a href="#">Total
                          <span>$<?php
                          $pay_total = number_format($total_price + $flat_rate);
                          echo $pay_total; ?></span>
                        </a>
                      </li>
                    </ul>
                    <!--<div class="payment_item">
                      <div class="radion_btn">
                        <input type="radio" id="f-option5" name="selector" />
                        <label for="f-option5">Check payments</label>
                        <div class="check"></div>
                      </div>
                      <p>
                        Please send a check to Store Name, Store Street, Store Town,
                        Store State / County, Store Postcode.
                      </p>
                    </div>-->
                    <div class="payment_item active">
                      <div class="radion_btn">
                        <input type="radio" checked="checked" id="f-option6" name="selector" />
                        <label for="f-option6">Paystack </label>
                        <img src="img/product/single-product/card.jpg" alt="" />
                        <div class="check"></div>
                      </div>
                      <p>
                        Please send a check to Store Name, Store Street, Store Town,
                        Store State / County, Store Postcode.
                      </p>
                    </div>
                    <div class="creat_account">
                      <input type="checkbox" id="f-option4" name="selector" />
                      <label for="f-option4">I’ve read and accept the </label>
                      <a >terms & conditions*</a>
                      <input type="hidden" name="amount" value="<?php echo $pay_total; ?>">
                      <input type="submit" name="pay" id="pay" value="Proceed to Paystack" class="btn_3" />
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    <?php
      }
      else
      {
    ?>
        <div class="container" style="height: 20vh;">
            <div class="row">
                <h3 style="opacity: 0.5;">Nothing to Order!</h3>
                <a class="btn_1" href="shop.php">Continue Shopping</a>
            </div>
        </div>
    <?php
      }
    ?>
        <!--================End Checkout Area =================-->
    </main>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.php"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
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
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>                   
                                          </div>
                                      </div>
                                      <div class="col-xl-5 col-lg-4 col-md-5">
                      <footer>
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