<?php
session_start();
require __DIR__. "/../config.php";
require __DIR__. '/../../vendor/autoload.php';

use \Models\User;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = User::create([
        "name" => $_POST["name"],
        "last_name" => $_POST["last_name"],
        "email"=> $_POST["email"],
        "password"=> password_hash($_POST["password"], PASSWORD_BCRYPT),
        "birthdate" => $_POST["birthdate"] ,
        "telephone_number" => $_POST["telephone-number"]
    ]
    );
    $_SESSION["id"] = $user->id;
    header("Location : src/");
    exit;
}
?>