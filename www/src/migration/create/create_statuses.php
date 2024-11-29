<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Models\OrderStatus;

Capsule::schema()->dropIfExists("order_status");

Capsule::schema()->create("order_status", function (Blueprint $table) {
    $table->id();
    $table->string("status_name")->unique();

});
OrderStatus::insert([
    ['status_name' => 'SUBMITED'],
    ['status_name'=> 'APPROVED'],
    ['status_name' => 'RESERVED'],
    ['status_name'=> 'CANCELED'],
])
?>