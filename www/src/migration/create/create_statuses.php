<?php
require __DIR__ . "/../../config.php";
require __DIR__ . '/../../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Models\OrderStatus;

Capsule::schema()->dropIfExists("order_status");

Capsule::schema()->create("order_status", function (Blueprint $table) {
    $table->id();
    $table->string("name",40);

});
OrderStatus::create(["name"=> "PLACED"]);
OrderStatus::create(["name"=> "RESERVED"]);
OrderStatus::create(["name"=> "APPROVED",]);
OrderStatus::create(["name"=> "CANCELED",]);
?>