<?php
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use Models\Cart;
use Models\User;
use Models\Product;
use Models\Order;

session_start();
$url = "/www/src/orders-page.php";
$order = Order::find($_GET['order']);
$relatedUser = $order->user;

if ($relatedUser->wallet->balance >= $order->total_price) {
    $order->order_status_id = Order::$APPROVED;
    $order->save();
}
$relatedUser->wallet->update([
    "balance"=> $relatedUser->wallet->balance - $order->total_price
]);
header("Location: $url?approved=true");
?>