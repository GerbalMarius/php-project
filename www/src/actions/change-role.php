<?php
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use Models\User;
use Models\Role;

if ($_POST['user_role'] === $_POST['selected_role']) {
    header('Location: /www/src/admin-page.php');
    exit;
}else{
    $user = User::find($_POST['user']);
    $role = Role::find($_POST['selected_role']);
    $user->roles()->sync($role->id);
    header('Location: /www/src/admin-page.php?role=true');
    exit;
}

?>