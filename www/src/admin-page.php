<?php

use Models\Order;
use Models\Role;
session_start();
require __DIR__ . "/config.php";
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/utils.php';
use Models\User;

$url = "/www/src";

if (!isset($_SESSION['user_id']) || !is_active_user($_SESSION['user_id']) || !has_role($_SESSION['user_id'], "ADMIN")) {
    header("Location: $url");
    exit;
}
$users = User::all()->filter(fn($user) => $user->id !== $_SESSION["user_id"]);
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
    <title>Visi vartotojai</title>
</head>
<body>
    <h1 class="form-heading">Visi vartotojai</h1><img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"> <a class="smaller-img-top-left" href="../src"></a>
    <?php
        if (isset($_GET["role"])) {
            echo "<p class ='success' style='font-size: 20px;'>Rolė pakeista.</p>";
        }
        if (isset($_GET["deactive"])) {
            echo "<p class ='success' style='font-size: 20px;'>Vartotojas išjungtas.</p>";
        }
        if (isset($_GET["active"])) {
            echo "<p class ='success' style='font-size: 20px;'>Vartotojas įjungtas.</p>";
        }
        ?>
    <div class="wrapper">
    <table style="position: relative; left:600px;">
        <tbody>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>El. paštas</th>
                <th>Telefono numeris</th>
                <th>Aktyvumo statusas</th>
                <th>Rolė</th>
            </tr>
            <tr>
            <?php
             if ($users->count() <= 0) {
                echo "<td colspan='6' style='color:red; font-weight:bold;'>Sistemos vartotojų nėra.</td>";
                echo "</tr>";
             }else{
                foreach ($users as $user) {
                    echo "<tr>";
                    $userRole = $user->roles->first();
                    $otherRoles = Role::all()->filter(fn($role) => $role->id !== $userRole->id);
                    echo "<td>{$user->name}</td>";
                    echo "<td>{$user->last_name}</td>";
                    echo "<td>{$user->email}</td>";
                    echo "<td>{$user->telephone_number}</td>";
                    $activeStatus = $user->is_active ? "Aktyvus" : "Neaktyvus";
                    echo "<td>{$activeStatus}  
                    <a href='actions/activate.php?usr={$user->id}' class='option-btn'style='border:none;position:relative;width:50px;background-color:green'>Įjungti</a>
                    <a href='actions/deactivate.php?usr={$user->id}' class='option-btn'style='border:none;position:relative;width:60px;background-color:red'>Išjungti</a>
                    </td>";
                    $name = Role::extractName($userRole->id);
                    echo "<td>";
                    echo "<form method='post' action='actions/change-role.php'>";
                    echo "<input type='hidden' name='user_role' value='{$userRole->id}'>";
                    echo "<input type='hidden' name='user' value='{$user->id}'>";
                    echo "<select name='selected_role' id='selected_role' class='form-input-smaller'>";
                    echo "<option value='{$userRole->id}'>{$name}</option>";
                    foreach ($otherRoles as $otherRole) {
                        $otherName = Role::extractName($otherRole->id);
                        echo "<option value='{$otherRole->id}'>{$otherName}</option>";
                    }
                echo"</select>";
                echo "<input type='submit' class='option-btn' style='border:none;position:relative;left:100px;width:100px;background-color:blue' value='Pakeisti rolę'>";
                echo "</form>";
                echo " </td>";
                echo "</tr>";
                }
                echo "</tr>";
             }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>