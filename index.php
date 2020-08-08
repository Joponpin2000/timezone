<?php

session_start();

include_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

if (isset($_GET['action']) && isset($_GET['code']) && isset($_GET['quantity']) && is_numeric($_GET['quantity'])) {
    switch ($_GET['action']) 
    {
        case 'add':
            if(!empty($_GET['quantity']))
            {
                $productById = $database->Read("SELECT * FROM products WHERE id = :id", ['id' => $_GET['code']]);
                $itemArray = array($productById[0]['id']=>array('name' => $productById[0]['name'], 'id' => $productById[0]['id'], 'quantity' => $_GET['quantity'], 'price' => $productById[0]['price'], 'image' => $productById[0]['image']));

                if (!empty($_SESSION["cart_item"])) 
                {
                    if (in_array($productById[0]["id"], array_keys($_SESSION["cart_item"]))) 
                    {
                        foreach ($_SESSION['cart_item'] as $k => $v)
                        {
                            if ($productById[0]['id'] == $k) 
                            {
                                if (empty($_SESSION['cart_item'][$k]['quantity']))
                                {
                                    $_SESSION['cart'][$k]['quantity'] = 0;
                                }
                                $_SESSION['cart_item'][$k]['quantity'] += $_GET["quantity"];
                            }
                        }
                    }
                    else
                    {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                }
                else
                {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
    }

}

?>

    <?php
        require_once('top.inc.php')
    ?>

    <main>
        <!--? slider Area Start -->
        <div class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center slide-bg">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Select Your New Perfect Style</h1>
                                    <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat is aute irure.</p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                        <a href="shop.php" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="assets/img/hero/watch.png" alt="" class=" heartbeat">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!-- ? New Product Start -->
        <section class="new-product-area section-padding30">
            <div class="container">
                <!-- Section tittle -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-tittle mb-70">
                            <h2>New Arrivals</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $statement = "SELECT * FROM products ORDER BY created_at DESC LIMIT 0, 3";
                        $products = $database->Read($statement);
                        foreach ($products as $product)
                        {
                    ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-pro mb-30 text-center">
                                    <div class="product-img">
                                        <img src="assets/img/gallery/<?php echo $product['image']; ?>" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <h3><a href="product_details.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h3>
                                        <span>$ <?php echo number_format($product["price"]); ?></span>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>
        <!--  New Product End -->

        <!--? Gallery Area Start -->
        <div class="gallery-area">
            <div class="container container-fluid p-0 fix">
                <div class="row">
                    <?php
                        $statement = "SELECT * FROM products ORDER BY created_at ASC LIMIT 0, 3";
                        $products = $database->Read($statement);
                        foreach ($products as $product)
                        {
                    ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-gallery mb-30">
                                    <div class="gallery-img big-img" style="background-image: url(assets/img/gallery/<?php echo $product['image']; ?>);"></div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
        <!--? Popular Items Start -->
        <div class="popular-items section-padding30">
            <div class="container">
                <!-- Section tittle -->
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="section-tittle mb-70 text-center">
                            <h2>Popular Items</h2>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $statement = "SELECT * FROM products ORDER BY popularity DESC LIMIT 0, 6";
                        $products = $database->Read($statement);
                        foreach ($products as $product)
                        {
                    ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/<?php echo $product['image']; ?>" alt="">
                                        <a href="index.php?action=add&code=<?php echo $product['id']; ?>&quantity=1">
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
                    ?>
                </div>
                <!-- Button -->
                <div class="row justify-content-center">
                    <div class="room-btn pt-70">
                        <a href="shop.php" class="btn view-btn1">View All Products</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popular Items End -->
        <!--? Video Area Start -->
        <div class="video-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                    <div class="video-wrap">
                        <div class="play-btn "><a class="popup-video" href="https://www.youtube.com/watch?v=KMc6DyEJp04"><i class="fas fa-play"></i></a></div>
                    </div>
                    </div>
                </div>
                <!-- Arrow -->
                <div class="thumb-content-box">
                    <div class="thumb-content">
                        <h3>Next Video</h3>
                        <a href="#"> <i class="flaticon-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Area End -->
        <!--? Watch Choice  Start-->
        <div class="watch-area section-padding30">
            <div class="container">
                <div class="row align-items-center justify-content-between padding-130">
                    <?php
                        $statement = "SELECT * FROM products ORDER BY popularity DESC LIMIT 0, 1";
                        $products = $database->Read($statement);
                    ?>
                        <div class="col-lg-5 col-md-6">
                            <div class="watch-details mb-40">
                                <h2>Watch of Choice</h2>
                                <p>Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                                <a href="shop.php" class="btn">Show Watches</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-10">
                            <div class="choice-watch-img mb-40">
                                <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                    <img src="assets/img/gallery/<?php echo $product['image']; ?>" alt="">
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- Watch Choice  End-->
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
    <?php
        require_once('bottom.inc.php');
    ?>
</body>
</html>