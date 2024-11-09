<?php
session_start();
require __DIR__. "/../config.php";
require __DIR__. '/../../vendor/autoload.php';
require __DIR__.'/../utils.php';

use \Models\User;

$errs = [
    "email" => "",
    "password"=> "", 
    "user" => "",
    "mismatch"=> "",

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = "/../src";
    $query_string = "";
    $user;
    if (empty($_POST['email'])) {
        $errs['email'] = 'none';
    }
    if (empty($_POST['password'])) {
        $errs['password'] = 'none';
    }
    if (!empty($_POST['email'])) {
        $entered_email = $_POST['email'];
        $user = User::where('email', test_input($entered_email))->first();
    }
    if (empty($user)) {
        $errs['user'] = 'none';
    }
    else if (!empty($user) && !password_verify($_POST['password'], $user->password)) {
        $errs['mismatch'] = 'true';
    }

    if (count($errs) > 0) {
        $query_string = http_build_query($errs);
        $url = "/../src/login-page.php";
        header("Location: $url?$query_string");
        exit;
    }
    


  
    $_SESSION['user_id'] = $user->id;
    header("Location: $url");
    exit;
}
?>