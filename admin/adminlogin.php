<?php

// include function file
require_once("../functions/DatabaseClass.php");

$database = new DatabaseClass();

//Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    //Check if username is empty
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $username = trim($_POST["username"]);
    }

    //check if password is empty
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    //validate credentials
    if(empty($username_err) && empty($password_err))
    {
        //prepare a select statement
        $sql = "SELECT id, username, password FROM admin WHERE username = :username AND password = :password";
        $result = $database->Read($sql, ['username' => $username, 'password' => $password]);

        // Check if username and password exists
        if(count($result) == 1)
        {
            //Unset all of the session variables
            $_SESSION = array();

            //Destroy the session.
            session_destroy();

            session_start();

            // Store data in session
            $_SESSION["admin"] = $username;

            // Redirect user to home page
            header("location: ./");
        }
        else
        {
            // Display an error message if username doesn't exist
            $password_err = "Invalid username / password combination.";
        }
    }
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
            <div class="center-block" style="margin: 100px auto; width: 70%;">
                <div class="container">
                    <div class="row">
                            <div class="col-sm-12 col-md-6 col-md-6" style="padding: 10px;">
                                <h4><span style="color: #7386D5;">Timezone </span> | Admin Login</h4>
                            </div>
                            <div class="col-sm-12 col-md-6 col-md-6" style="background-color: white; padding: 10px;">
                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required/>
                                        <span class="help-block" style="color:red;"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required/>
                                        <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
                                    </div>
                                    <button type="submit" style="background-color: #7386D5; border-color: #7386D5" class="btn btn-warning btn-block">Submit</button>
                                    <a href="" class="pull-left" style="color: red;">Forgot Password?</a>
                                </form>
                            </div>
                    </div>
                </div>    
            </div>

        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="center-block">
                        <p>All Rights Reserved. &copy; 2020 <b><a href="../" style="color: inherit;">Timezone</a></b> Developed by : <a href="http://jofedo.netlify.app" target="_blank"><b>Idowu Joseph</b></a></p>
                    </div>
                </div>
            </div><!-- end container -->
        </div><!-- end copyrights -->
    
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
    
    </body>
</html>