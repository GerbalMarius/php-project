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
$order->order_status_id = Order::$RESERVED;
$order->save(); 

$url = "/www/src/orders-page.php";
header("Location: $url?reserved=true");
?>