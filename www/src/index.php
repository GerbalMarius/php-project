<?php
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Pagrindinis puslapis</title>
</head>
<body>
    <h1>Visos prekės</h1>
    <img src="src/images/acount-icon.svg" alt="face" class="smaller-img-top-right"><a href="src/login-page.php" style="text-decoration:none" class="smaller-img-top-right"></a>
    <?php

    use Models\User;
    require __DIR__. "/config.php";
    require __DIR__. '/../vendor/autoload.php';
    if (isset($_SESSION['user_id'])) {
        $user = User::find($_SESSION['user_id']);
        echo "Prisijunges vartotojas: ".$user->email;
        echo  "<a href='src/actions/logout.php'>Atsijungti</a>";
    }
    ?>
    <footer>
        © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y")." m." ?>
    </footer>
</body>
</html>