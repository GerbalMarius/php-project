<?php

session_start();
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';
use Models\User;
use Models\Product;

if (empty($_POST["prod_id"])){
    header("Location: /www/src");
    exit;
}

$product = Product::find($_POST["prod_id"]);
$product->total_units += $_POST["quantity"];
$product->save();


header("Location: /www/src?updated=true");
exit;