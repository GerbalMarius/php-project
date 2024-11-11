<?php
session_start();
use Models\User;
use Models\Product;
require __DIR__ . "/config.php";
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/utils.php';
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
    <title>Krepšelis</title>
</head>

<body>
    <img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"><a class="smaller-img-top-left"
        href="../src"></a>
    <h1 style="margin-top:40px;">Placeholder for cart items</h1>
    <div class="wrapper">
    <table>
        <tbody>
            <tr>
                <th>Pavadinimas</th>
                <th>Gamintojas</th>
                <th>Modelis</th>
                <th>Kategorija</th>
                <th>Kaina</th>
            </tr>
            <tr>
                <?php
                if(empty($_SESSION["cart"])) {
                    echo "<td colspan='5' style='color:red; font-weight:bold;'>Krepšelis tuščias.</td>";
                    echo "</tr>";
                } else {
                    $items = $_SESSION["cart"];
                    $price_sum = array_sum(array_column($_SESSION["cart"], "price"));
                    foreach($items as $item) {
                        echo "<td>{$item["title"]}</td>";
                        echo "<td>{$item["manufacturer"]}</td>";
                        echo "<td>{$item["model"]}</td>";
                        echo "<td>{$item["category"]}</td>";
                        echo "<td>{$item["price"]}€</td>";
                        echo "</tr>";
                    }
                    echo"<tr><td colspan='5' style='text-align:right; font-weight:bold;'>Iš viso mokėti : {$price_sum}€</td></tr>";
                    echo"</tr>";
                }
                
                ?>
        </tbody>
    </table>
    <a href='actions/clear-cart.php' class ='red-btn-table'>Valyti krepšelį</a>
    </div>
    <footer>
        © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y") . " m." ?>
    </footer>
</body>
</html>