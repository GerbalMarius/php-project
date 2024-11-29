<?php
session_start();
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
            <input class="form-input" type="text" name="product_name" maxlength="80">
            <p></p>
            <label for="product_manufacturer" class="form-label">Prekės gamintojas</label>
            <input class="form-input" type="text" name="product_manufacturer" maxlength="80">
            <p></p>
            <label for="product_model" class="form-label">Modelis</label>
            <input class="form-input" type="text" name="product_model" maxlength="80">
            <p></p>
            <label for="product_category" class="form-label">Kategorija/paskirtis</label>
            <input class="form-input" type="text" name="product_category" maxlength="80">
            <p></p>
            <label for="product_unit_price" class="form-label">Vieneto kaina €</label>
            <input class="form-input" type="number" name="product_unit_price" step="0.1" min="1.00" max="999.999">
            <p></p>
            <label for="product_count" class="form-label">Kiekis</label>
            <input class="form-input" type="number" name="product_count" min="1" max="100">
            <p></p>
            <label class="form-label" for="product_discount">Nuolaida %</label>
            <input class="form-input" type="number" name="product_discount" step="0.1" min="0.0" max="99.99">
            <p></p>
            <label class="form-label">Paveiksliukas</label>
            <p></p>
            <label class="form-upload" for="product_pict"><img src="images/upload-icon.svg" style="width: 60px; height:60px;"></label><span id="img-text"></span>
            <input class="form-input" type="file" name="product_pict" style="display:none" id="product_pict"  accept="image/jpeg">
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
