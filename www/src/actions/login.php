<?php
session_start();
require __DIR__. "/../config.php";
require __DIR__. '/../../vendor/autoload.php';

use \Models\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    


    $entered_email = $_POST['email'];
    $user = User::where('email', $entered_email)->first();
    $_SESSION['user_id'] = $user->id;
    header("Location: /../src");
    exit;
}
?>