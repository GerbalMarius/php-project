<?php
require __DIR__ . "/../config.php";
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../utils.php';

use Models\User;
$user = User::find($_GET['usr']);
$user->is_active = false;
$user->save();
header('Location: /www/src/admin-page.php?deactive=true');
exit;
?>