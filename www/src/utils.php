<?php
use \Models\User;
require __DIR__ . "/config.php";
require __DIR__ . '/../vendor/autoload.php';
function test_input($input): string  {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
function calculate_discount($price, $discount): float {
    $price = floatval($price);
    $discount = round(floatval($discount) / 100, 1);
    
    return round($price - $price * $discount, 2);
}

function is_active_user($user_id): bool {
    $actual_user = User::find($user_id);
    return $actual_user->is_active;
}
function has_role($user_id,$role): bool {
    $actual_user = User::find($user_id);
    if (empty($actual_user) || empty($actual_user->roles)) {
        return false;
    }

    return $actual_user->roles->contains("name", $role);
}
?>