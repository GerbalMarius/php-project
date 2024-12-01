<?php
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use Models\Cart;
use Models\User;
use Models\Product;
use Models\Order;
session_start();
if (!empty($_SESSION["cart"])) {
    
    $items = $_SESSION["cart"];
    $userId = $_SESSION["user_id"];
    $user = User::find($userId);
    $totalPrice = 0;
    $totalAmount = 0;

    $cart = Cart::create([
        "user_id" => $userId,
        "full_price" => $totalPrice,
        "cart_date" => date("Y-m-d")
    ]);

    foreach ($items as $item) {
        $product = Product::find($item["id"]);


        $product->total_units -= $item["ordered_amount"];
        $product->save();

        $itemTotal = $item["ordered_amount"] * $item["price"];
        $totalPrice += $itemTotal;
        $totalAmount += $item["ordered_amount"];

        $cart->products()->attach($product->id,[
            "quantity" => $item["ordered_amount"],
            "price" => $item["price"]
        ]);
    }


   $order = Order::create(
        [
            "order_status_id" => $user->wallet->balance >= $totalPrice ? Order::$PLACED : Order::$RESERVED,
            "date" => date("Y-m-d"),
            "amount" => $totalAmount,
            "total_price" => $totalPrice,
            "user_id" => $userId,
            "cart_id" => $cart->id
        ]
        );
    
        $cart->full_price = $totalPrice;
        $cart->order_id = $order->id;
        $cart->save();
    
        $user->carts()->save($cart);
    $_SESSION["cart"] = [];
    unset($_SESSION["cart"]);
    header("Location: /www/src/cart-page.php?success=true");
    exit;
}

?>