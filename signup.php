<?php
//initialize the session

session_start();

//check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION['user']) && isset($_SESSION['id']))
{
    header("location: ./");
    exit;
}

include_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

$msg = "";
$firstname = $lastname = $email = $username = $password = $rpassword = "";
$firstname_err = $lastname_err = $email_err = $username_err = $password_err = $rpassword_err = "";

if ($_SERVER["REQUEST_METHOD"] =="POST")
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

    //VALIDATE USERNAME
    if (empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $username = trim($_POST["username"]);

        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $database->Read($sql, ['username' => $username]);

        if(count($stmt) == 1)
        {
            $username_err = "This username is already taken.";
        }
    }

    //validate password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";
    }
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have at least 6 characters.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    //validate repeat password
    if(empty(trim($_POST["rpassword"])))
    {
        $rpassword_err = "Please repeat password.";
    }
    else
    {
        $rpassword = trim($_POST["rpassword"]);
        if(empty($password_err) && ($password != $rpassword))
        {
            $rpassword_err = "Password did not match.";
        }
    }

    //Check input errors before inserting in databse
    if((empty($firstname_err) && empty($lastname_err)) 
        && (empty($username_err) && empty($email_err)) 
        && (empty($password_err) && empty($rpassword_err)))
    {
        $sql = "INSERT INTO users(username, password, firstname, lastname, email) VALUES (:username, :password, :firstname, :lastname, :email)";
        $stmt = $database->Insert($sql, ['username' => $username, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email]);
        $msg = "You have successfully registered. Please proceed to login page.";
        echo "<script>alert('$msg');</script>";
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
                                <h2>SignUp</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!--================login_part Area =================-->
        <section class="login_part section_padding ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_text text-center">
                            <div class="login_part_text_iner">
                                <p>There are advances being made in science and technology
                                    everyday, and a good example of this is the</p>
                                <a href="login.php" class="btn_3">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Welcome ! <br> Please fill in your details</h3>
                                <form class="row contact_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" onsubmit="return(validateLogin(this))">
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>" placeholder="Firstname">
                                        <span class="help-block" style="color:red;"><?php echo $firstname_err; ?></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>" placeholder="Lastname">
                                            <span class="help-block" style="color:red;"><?php echo $lastname_err; ?></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
                                        <span class="help-block" style="color:red;"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="name" name="username" value="<?php echo $username; ?>" placeholder="Username">
                                        <span class="help-block" style="color:red;"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Password">
                                            <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="rpassword" name="rpassword" value="<?php echo $rpassword; ?>" placeholder="Repeat Password">
                                            <span class="help-block" style="color:red;"><?php echo $rpassword_err; ?></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">
                                            Sign In
                                        </button>
                                        <a class="lost_pass" href="#">forget password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================login_part end =================-->
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
    
    <!-- Scroll up, nice-select, sticky -->
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