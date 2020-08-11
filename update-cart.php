<?php

session_start();

include_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

$product_id = $_GET['id'];
$action = $_GET['action'];


if($action === 'empty')
{
  echo "string";
  unset($_SESSION['cart']);
}

$statement = "SELECT * FROM products WHERE id=:id";
$products = $database->Read($statement, ["id" => $product_id]);

switch($action)
{
  case "add":
      $_SESSION['cart'][$product_id]++;
    break;

  case "remove":
    unset($_SESSION['cart'][$product_id]);

    if(count($_SESSION['cart']) == 0)
    {
      unset($_SESSION['cart']);
    }
    break;
}

header("location:cart.php");

?>