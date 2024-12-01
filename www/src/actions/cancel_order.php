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
$relatedCart = $order->cart;

?>
<h1><?php echo var_dump($cart->id)?></h1>