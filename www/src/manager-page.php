<?php
session_start();
require __DIR__ . "/config.php";
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/utils.php';
use Models\User;

$url = "/www/src";

if (!isset($_SESSION['user_id']) || !is_active_user($_SESSION['user_id']) || !has_role($_SESSION['user_id'], "MANAGER")) {
    header("Location: $url");
    exit;
}

$user = User::find($_SESSION["user_id"]);
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
        <title>Vadybininko langas</title>
</head>
<body>
    <h1 class="form-heading">Paskyros informacija</h1><img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"> <a class="smaller-img-top-left" href="../src"></a>
    <h2 class="form-heading">Vardas: <?php echo "{$user->name}"; ?></h2>
    <h2 class="form-heading">Pavardė: <?php echo "{$user->last_name}"; ?></h2>
    <h2 class="form-heading">El. paštas: <?php echo "{$user->email}"; ?></h2>
    <h2 class="form-heading">Telefono numeris: <?php echo "{$user->telephone_number}"; ?></h2>
    <h2 class="form-heading">Gimimo data: <?php echo "{$user->birthdate}"; ?></h2>
    <h2 class="form-heading">Varotojų užsakymai:</h2>
    <br>
    <a href="orders-page.php" class="form-submit-smaller" style="text-decoration:none; position:relative; left:-41rem;">Peržiūrėti užsakymus</a>
</body>
</html>