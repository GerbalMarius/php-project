<?php
 use Models\User;
 use Models\Product;
 require __DIR__ . "/config.php";
 require __DIR__ . '/../vendor/autoload.php';
 require __DIR__ . '/utils.php';

 session_start();
?>
<!DOCTYPE html>
<html lang="lt-LT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/form-styles.css" type="text/css">
    <link rel="stylesheet" href="src/styles/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Pagrindinis puslapis</title>
</head>

<body>
    <h1>
        Visos prekės
        <?php
        if (isset($_GET["cart"])) {
            echo "<p class ='success' style='font-size: 20px;'>Prekė sėkmingai idėta į krepšelį.</p>";
        }
        if (isset($_GET["produce"])) {
            echo "<p class ='success' style='font-size: 20px;'>Prekė sėkmingai įtraukta į katalogą.</p>";
        }
        ?>
    </h1>
    <img src="src/images/cart.svg" alt="cart" class="smaller-img-top-right" style="margin-right: 40px;"><a href="src/cart-page.php"
    style="text-decoration:none; right:40px;" class="smaller-img-top-right"></a>
    <img src="src/images/acount-icon.svg" alt="face" class="smaller-img-top-right"><a href="src/login-page.php"
        style="text-decoration:none" class="smaller-img-top-right"></a>
    <?php
    if (isset($_SESSION['user_id'])) {
        $user = User::find($_SESSION['user_id']);
        echo "<p class='text-top-right'>{$user->email}</p>";
        echo "<a href='src/actions/logout.php' class='logout-btn-top-right'>Atsijungti</a>";
    }
    if (isset($_SESSION["cart"])) {
        $total_amount = count($_SESSION["cart"]);
        echo "<a class='logout-btn-top-right' style='right:43px; width:10px; padding:10px;'>{$total_amount}</a>";
    }
    $products = Product::all();
    echo "<div class = 'items'>";
    foreach ($products as $product) {
        $price_text = "<p class = 'item-text-price'>" . calculate_discount($product->unit_price, $product->discount) . "€/vnt</p>";
        if ($product->discount >= 1) {
            $price_text .= "<p class='item-text-discount'>" . round($product->discount, 1) . "% Nuolaida</p>";
        }
        echo "<div class = 'item'>";
        echo "<p class ='item-title'>{$product->title}</p>";
        echo "<p class = 'item-text-general'>{$product->manufacturer}</p>";
        echo "<p class = 'item-text-general'>{$product->category} </p>";
        echo "<p class = 'item-text-general'>{$product->model} </p>";
        echo Product::image_str($product->id);
        echo $price_text;
        echo "<form action='src/actions/to-cart.php' method='post'>";
        echo "<label for='quantity-{$product->id}' class='item-label'>Kiekis:</label>";
        echo "<input type='number' id='quantity-{$product->id}' name='quantity' value='1' min='1' max={$product->total_units} class='form-input-smaller' style='margin-left:0rem !important; width:10rem !important;'>";
        echo "<input type='hidden' name='prod_id' value='{$product->id}'>"; // Pass the product ID
        echo "<input type='submit' class='form-submit-smaller' style='margin-left:0rem; !important; width:10rem;' value='Į krepšelį'>";
        echo "</form>";
    
    echo "</div>";
    }
    echo "</div>";
    ?>
    <footer>
        © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y") . " m." ?>
    </footer>
</body>

</html>