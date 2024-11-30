<?php

session_start();
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';
use Models\User;
use Models\Product;

if (empty($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}
if (empty($_POST["prod_id"])){
    header("Location: /www/src");
    exit;
}

$product = Product::find($_POST["prod_id"]);


$_SESSION["cart"][] = [
    "id" => $product->id,
    "title" => $product->title,
    "manufacturer" => $product->manufacturer,
    "model" => $product->model,
    "category" => $product->category,
    "price" => calculate_discount($product->unit_price, $product->discount),
    "ordered_amount" => $_POST["quantity"]
];
header("Location: /www/src?cart=true");
exit;


