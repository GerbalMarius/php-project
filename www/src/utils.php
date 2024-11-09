<?php
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
?>