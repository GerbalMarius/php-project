<?php
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use Models\User;
use Models\Product;
session_start();
if (!empty($_SESSION["cart"])) {
    
    $items = $_SESSION["cart"];

    foreach ($items as $item) {
        $product = Product::find($item["product_id"]);
        
    }
}

?>