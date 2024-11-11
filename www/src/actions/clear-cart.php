<?php
session_start();
$url = "/www/src/cart-page.php";

if(!empty($_SESSION["cart"])){
    unset($_SESSION["cart"]);
    
}
header("Location: $url");
exit;
