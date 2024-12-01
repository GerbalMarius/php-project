<?php
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use Models\Cart;
use Models\User;
use Models\Product;
use Models\Order;

session_start();
$order = Order::find($_GET['order']);
$url = "/www/src/orders-page.php";
$relatedCart = Cart::find($order->cart_id);
$products = $relatedCart->products;

foreach ($products as $product) {
    $orderedQuanity = $product->pivot->quantity;
    $product->total_units = $orderedQuanity + $product->total_units;
    $product->save();
}
$order->order_status_id = Order::$CANCELED;
$order->save();
header("Location: $url?canceled=true");
?>
<h1><?php ?></h1>