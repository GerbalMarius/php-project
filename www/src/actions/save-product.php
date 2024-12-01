<?php

use Models\Product;
session_start();
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

$url = "/www/src?produce=true";

$image;

if (isset($_FILES["product_pict"]) && $_FILES["product_pict"]["error"] === UPLOAD_ERR_OK) {
    $image = $_FILES["product_pict"];
}
$requiredFields = [
    "product_name" => "Product Name",
    "product_manufacturer" => "Manufacturer",
    "product_model" => "Model",
    "product_category" => "Category",
    "product_unit_price" => "Price",
    "product_count" => "Quantity",
    "product_discount" => "Discount"
];

$errs = [];


foreach ($requiredFields as $fieldKey => $fieldName) {
    if (isset($_POST[$fieldKey]) && !empty(trim($_POST[$fieldKey]))) {
        $_SESSION[$fieldKey] = test_input($_POST[$fieldKey]);
    } else {
        unset($_SESSION[$fieldKey]);
        $errs[$fieldKey] = $fieldName;
    }
}


if (count($errs) > 0) {
    $url = "/www/src/products-form.php";
    $query = http_build_query( $errs);
    header("Location: $url?$query");
    exit;
}


foreach (array_keys($requiredFields) as $fieldKey) {
    unset($_SESSION[$fieldKey]);
}
$product_name = $_POST["product_name"];
$product_manufacturer = $_POST["product_manufacturer"];
$product_model = $_POST["product_model"];
$product_category = $_POST["product_category"];
$product_price = $_POST["product_unit_price"];
$product_quantity = $_POST["product_count"];
$product_discount = $_POST["product_discount"];


$imageData = file_get_contents($image['tmp_name']);
$base64Data = base64_encode($imageData);

$compressedData = gzcompress($base64Data);

Product::create(
    [
        'title' => test_input($product_name),
        'manufacturer'=> test_input($product_manufacturer),
        'model' => test_input($product_model),
        'category'=> test_input($product_category),
        'image_data' => $compressedData,
        'unit_price' => test_input($product_price),
        'discount' => test_input($product_discount),
        'total_units'=> test_input($product_quantity),
    ]
);
header("Location: $url");
exit;