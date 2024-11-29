<?php
require __DIR__ . "/../../config.php";
require __DIR__ . '/../../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Models\OrderStatus;

Capsule::schema()->dropIfExists("order_status");

Capsule::schema()->create("order_status", function (Blueprint $table) {
    $table->id();
    $table->string("status_name")->unique();

});
OrderStatus::create(["status_name"=> "PLACED"]);
OrderStatus::create(["status_name"=> "RESERVED"]);
OrderStatus::create(["status_name"=> "APPROVED",]);
OrderStatus::create(["order_status"=> "CANCELED",]);
?>