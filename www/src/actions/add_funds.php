<?php

use Models\User;
session_start();
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

$url = "/www/src/account-page.php?success=true";

if (empty($_SESSION['user_id']) || !is_active_user($_SESSION['user_id']) || empty($_POST["funds"])) {
    header("Location: /www/src");
    exit;
}

$user = User::find($_SESSION["user_id"]);
$funds = $_POST["funds"];
if (is_numeric($funds)) {
    $funds = floatval($funds);
    $user->wallet->update([
        "balance"=> $funds + $user->wallet->balance
    ]);
    header("Location: $url");
    exit;
}else{
    header("Location: /www/src/account-page.php");
}
?>