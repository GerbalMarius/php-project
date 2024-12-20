<?php
session_start();

require "utils.php";
$url = "/www/src";
if (empty($_SESSION['user_id']) || !is_active_user($_SESSION['user_id']) || !has_role($_SESSION["user_id"], "MANAGER")) {
    header("Location: $url");
    exit;
}
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
    <title>Naujos prekės įvedimas</title>
</head>
<body>
    <img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"><a class="smaller-img-top-left" href="../src"></a>
    <div class="form-box">

        <h1 class="form-heading">Naujos prekės įvedimas</h1>

        <form action="actions/save-product.php" method="post" enctype="multipart/form-data">
            <label for="product_name" class="form-label">Prekės pavadinimas</label>
            <input class="form-input" type="text" name="product_name" maxlength="80" value="<?php echo htmlspecialchars($_SESSION['product_name'] ?? "") ?>">
            <?php
            if(isset($_GET["product_name"])) {
                echo "<span class = 'error'>*Pavadinimas būtinas.</span>";
            }
            ?>
            <p></p>
            <label for="product_manufacturer" class="form-label">Prekės gamintojas</label>
            <input class="form-input" type="text" name="product_manufacturer" maxlength="80" value="<?php echo htmlspecialchars($_SESSION['product_manufacturer'] ?? "") ?>">
            <?php
            if(isset($_GET["product_manufacturer"])) {
                echo "<span class = 'error'>*Gamintojas būtinas.</span>";
            }
            ?>
            <p></p>
            <label for="product_model" class="form-label">Modelis</label>
            <input class="form-input" type="text" name="product_model" maxlength="80" value="<?php echo htmlspecialchars($_SESSION['product_model'] ?? "") ?>">
            <?php
            if(isset($_GET["product_model"])) {
                echo "<span class = 'error'>*Modelis būtinas.</span>";
            }
            ?>
            <p></p>
            <label for="product_category" class="form-label">Kategorija/paskirtis</label>
            <input class="form-input" type="text" name="product_category" maxlength="80" value="<?php echo htmlspecialchars($_SESSION['product_category'] ?? "") ?>">
            <?php
            if(isset($_GET["product_category"])) {
                echo "<span class = 'error'>*Kategorija būtina.</span>";
            }
            ?>
            <p></p>
            <label for="product_unit_price" class="form-label">Vieneto kaina €</label>
            <input class="form-input" type="number" name="product_unit_price" step="0.1" min="1.00" max="999.999" value="<?php echo htmlspecialchars($_SESSION['product_unit_price'] ?? "") ?>">
            <?php
            if(isset($_GET["product_unit_price"])) {
                echo "<span class = 'error'>*Kaina būtina.</span>";
            }
            ?>
            <p></p>
            <label for="product_count" class="form-label">Kiekis</label>
            <input class="form-input" type="number" name="product_count" min="0" max="100" value="<?php echo htmlspecialchars($_SESSION['product_count'] ?? "") ?>">
            <?php
            if(isset($_GET["product_count"])) {
                echo "<span class = 'error'>*Kiekis būtinas.</span>";
            }
            ?>
            <p></p>
            <label class="form-label" for="product_discount">Nuolaida %</label>
            <input class="form-input" type="number" name="product_discount" step="0.1" min="0.0" max="99.99" value="<?php echo htmlspecialchars($_SESSION['product_discount'] ?? "") ?>">
            <?php
            if(isset($_GET["product_discount"])) {
                echo "<span class = 'error'>*Nuolaidos laukas tuščias.</span>";
            }
            ?>
            <p></p>
            <label class="form-label">Paveiksliukas</label>
            <p></p>
            <label class="form-upload" for="product_pict"><img src="images/upload-icon.svg" style="width: 60px; height:60px;"></label><span id="img-text"></span>
            <input class="form-input" type="file" name="product_pict" style="display:none" id="product_pict"  accept="image/jpeg" required>
            <p></p>
            <input type="submit" class="form-submit" value="Išsaugoti prekę" >
        </form>
    </div>
    <script>
        // JavaScript to display the file name after file is selected
        document.getElementById('product_pict').addEventListener('change', function(event) {
            const fileInput = event.target;
            const fileName = fileInput.files[0] ? fileInput.files[0].name : "Pasirinkite paveiksliuką.";
            document.getElementById('img-text').innerHTML = fileName;
        });
    </script>
    <footer>
        © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y") . " m." ?>
    </footer>
</body>
</html>
