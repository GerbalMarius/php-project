<?php

use Models\Role;
session_start();
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use \Models\User;

$errs = [
    "name" => "",
    "last_name" => "",
    "email" => "",
    "password" => "",
    "birthdate" => "",
    "telephone_number" => "",
];
$fields = [
    "name" => "none",
    "last-name" => "none",
    "email" => "none",
    "password" => "none",
    "birthdate" => "none",
    "telephone-number" => "none"
];


$url = "/../www/src";
$query_string = "";

foreach ($fields as $field => $error_message) {
    $normal_field = str_replace("-", "_", $field);
    if (empty($_POST[$field])) {
        $input = "input_";
        $_SESSION["{$input}{$normal_field}"] = "";
        $errs[$normal_field] = $error_message;
    } else {
        $input = "input_";
        $_SESSION["{$input}{$normal_field}"] = $_POST[$field];
        unset($errs[$normal_field]);
    }
}
if (empty($_POST["repeated-passwd"]) || $_POST["repeated-passwd"] !== $_POST["password"] || empty($_POST["password"])) {
    $errs["repeated_passwd"] = "error";
    unset($_SESSION["input_repeat"]);

}

if (!empty($_POST["repeated-passwd"])) {
    $_SESSION["input_repeat"] = $_POST["repeated-passwd"];

}

if (!empty($_POST["repeated-passwd"]) && $_POST["repeated-passwd"] === $_POST["password"]) {
    unset($errs["repeated_passwd"]);
}

if (count($errs) > 0) {
    $query_string = http_build_query($errs);
    $url = "/www/src/register-page.php";
    header("Location: $url?$query_string");
    exit;
} else {
    $user = User::create(
        [
            "name" => test_input($_POST["name"]),
            "last_name" => test_input($_POST["last-name"]),
            "email" => test_input($_POST["email"]),
            "password" => password_hash(test_input($_POST["password"]), PASSWORD_BCRYPT),
            "birthdate" => test_input($_POST["birthdate"]),
            "telephone_number" => test_input($_POST["telephone-number"])
        ]
    );
    $selected_role = Role::find($_POST["user_role"]);
    $user->roles()->attach($selected_role->id);
    $user->wallet()->create([
        "balance"=> 50,
    ]);
    session_unset();
    $_SESSION["user_id"] = $user->id;
    header("Location: $url");
    exit;
}
?>