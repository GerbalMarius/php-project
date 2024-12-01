<?php
require "utils.php";
use Models\Order;
session_start();
$redUrl = "/www/src";
if (empty($_SESSION['user_id']) || !has_role($_SESSION['user_id'], "MANAGER")){
    header("Location: $redUrl");
}
$orders = Order::all();
$placedOrders = $orders->filter(fn($order) => $order->order_status_id === Order::$PLACED);
?>

<!DOCTYPE html>
<html lang="lt-LT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form-styles.css" type="text/css">
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Užsakymai</title>
</head>
<body>
    <h1 class="form-heading">Vartotojų užsakymai</h1><img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"> <a class="smaller-img-top-left" href="../src"></a>
    <?php
    if (isset($_GET['approved'])) {
        echo "<p class ='success' style='font-size: 20px;'>Užsakymas patvirtintas.</p>";
    }
    ?>
    <div class="wrapper">
    <table style="position: relative; left:100px;">
        <tbody>
            <tr>
                <th>Pilna kaina</th>
                <th>Kiekis</th>
                <th>Data</th>
                <th>Vartotojo el. paštas</th>
                <th>Vartotojo piniginės likutis</th>
                <th>Užsakymo parinktys</th>
            </tr>
            <tr>
            <?php
            if ($placedOrders->count() <= 0) {
                echo "<td colspan='5' style='color:red; font-weight:bold;'>Užsakymų šiuo metu nėra.</td>";
                    echo "</tr>";
            }else {
                foreach ($placedOrders as $order) {
                    $relatedUser = $order->user;
                    echo "<td>{$order->total_price}€</td>";
                    echo "<td>{$order->amount}</td>";
                    echo "<td>{$order->date}</td>";
                    echo "<td>{$relatedUser->email}</td>";
                    echo "<td>{$relatedUser->wallet->balance}€</td>";
                    echo "<td>
                        <a href='actions/reserve_order.php?order={$order->id}' class='option-btn' style='background-color:blue'>Rezervuoti </a>
                        <a href='actions/approve_order.php?order={$order->id}' class = 'option-btn' style='background-color:green'> Patvirtinti</a> 
                        <a href='actions/cancel_order.php?order={$order->id}' class='option-btn'> Atšaukti</a>
                    </td>";
                }
                echo "</tr>";
            }
            ?>
            
        </tbody>
    </table>   
    </div>
</body>
</html>