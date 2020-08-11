<?php
session_start();

require_once("functions/DatabaseClass.php");

if(isset($_GET['id']))
{
    $id = trim($_GET['id']);
    $database = new DatabaseClass();

    $statement = "SELECT * FROM products WHERE id=:id";

    $product = $database->Read($statement, ['id' => $id]);

    /*if (isset($_GET['action'])) 
    {
        switch ($_GET['action'])
        {
        case 'add':
        if (!empty($_POST['quantity']) && is_numeric($_POST['quantity']))
        {
            $itemArray = array($product[0]['id'] => array('name' => $product[0]['name'], 
                'id' => $product[0]['id'], 'quantity' => $_POST['quantity'], 'price' => $product[0]['price'], 'image' => $product[0]['image']));

            if (!empty($_SESSION['cart_item']))
            {
                if (in_array($product[0]['id'], array_keys($_SESSION['cart_item'])))
                {
                    foreach ($_SESSION['cart_item'] as $k => $v)
                    {
                        if ($product[0]['id'] == $k)
                        {
                            if (empty($_SESSION['cart_item'][$k]['quantity']))
                            {
                                $_SESSION['cart_item'][$k]['quantity'] = 0;
                            }
                            $_SESSION['cart_item'][$k]['quantity'] += $_POST['quantity'];
                        }
                    }
                }
                else
                {
                    $_SESSION['cart'] = array_merge($_SESSION['cart_item'], $itemArray);
                }
            }
            else
            {
                $_SESSION['cart_item'] = $itemArray;
            }
        }
        break;
        }
    }
    */
}
?>


<?php
require_once('top.inc.php')
?>

<main>
        <!-- Hero Area Start-->
        <div class="slider-area" style="margin-bottom: 200px;">
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
        <!--================Single Product Area =================-->
        <div class="product_image_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="single_product_img">
                            <img src="assets/img/gallery/<?php echo $product[0]['image'] ?>" alt="#" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single_product_text text-center">
                        <h3><?php echo $product[0]['name'] ?></h3>
                        <p>
                            <?php echo $product[0]['description'] ?>
                        </p>
                        <div class="card_area">
                            <form action="product_details.php?action=add&id=<?php echo $product[0]['id']; ?>" method="POST">
                                <div class="product_count_area">
                                    <!--
                                    <p class="col-sm-2">Quantity</p>
                                    <div class="product_count d-inline-block">
                                        <span class="product_count_item inumber-decrement"> 
                                            <i class="ti-minus"></i>
                                        </span>
                                            <a style="padding:5px; color: inherit;" href="update-cart.php?action=add&id=<?php echo $product[0]['id']; ?>">
                                                <i class="ti-minus"></i>
                                            </a>
                                        <input class="product_count_item input-number" name="quantity" type="text" value="1" min="0" max="10" disabled="disabled">
                                        <!--<span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                        <a style="padding:5px; color: inherit;" href="update-cart.php?action=remove&id=<?php echo $product[0]['id']; ?>">
                                            <i class="ti-plus"></i>
                                        </a>
                                    </div>-->
                                    <p class="col-sm-2"> $<?php echo number_format($product[0]['price']) ?></p>
                                </div>
                                <div class="add_to_cart">
                                    <a href="
                                        <?php
                                            if(isset($_SESSION['user']) && isset($_SESSION['id']))
                                            {
                                                echo "update-cart.php?action=add&id=" . $product[0]['id'] . "";
                                            }
                                            else
                                            {
                                                echo "login.php";
                                            }
                                        ?>
                                    " class="btn_3" >ADD TO CART</a>  
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Single Product Area =================-->
        <!-- subscribe part here -->
        <section class="subscribe_part section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="subscribe_part_content">
                            <h2>Get promotions & updates!</h2>
                            <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic” sources credibly innovate granular internal .</p>
                            <div class="subscribe_form">
                                <input type="email" placeholder="Enter your mail">
                                <a href="#" class="btn_1">Subscribe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe part end -->
    </main>
    <?php
        require_once('bottom.inc.php');
    ?>
</body>

</html>