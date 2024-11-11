<?php
session_start();
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use \Models\User;

$url = "/www/src";



$errs = [
    "email" => "",
    "password" => "",
    "mismatch" => "",
];

$query_string = "";
$user;
if (empty($_POST['email'])) {
    $errs['email'] = 'none';
    unset($_SESSION['input_email']);
} else {
    $_SESSION['input_email'] = $_POST['email'];
    unset($errs['email']);
}
if (empty($_POST['password'])) {
    $errs['password'] = 'none';
    unset($_SESSION['input_password']);
} else {
    $_SESSION['input_password'] = $_POST['password'];
    unset($errs['password']);
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $entered_email = $_POST['email'];
    $user = User::where('email', test_input($entered_email))->first();
    $_SESSION['input_email'] = $_POST['email'];
}
if (!empty($_POST['email']) && !empty($_POST['password']) && empty($user)) {
    $errs['user'] = 'none';

} else if (!empty($user) && !empty($_POST['password']) && !password_verify($_POST['password'], $user->password)) {
    $errs['mismatch'] = 'true';
    $_SESSION['input_password'] = $_POST['password'];
} else {
    unset($errs['mismatch']);
}

if (count($errs) > 0) {
    $query_string = http_build_query($errs);
    $url = "/www/src/login-page.php";
    header("Location: $url?$query_string");
    exit;
} else {
    unset($_SESSION['input_email']);
    unset($_SESSION['input_password']);
    $_SESSION['user_id'] = $user->id;
    header("Location: $url");
    exit;
}
?>