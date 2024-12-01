<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("carts");

Capsule::schema()->create("carts", function (Blueprint $table) {
    $table->id();
    $table->decimal("full_price",10,3)->default(0);
    $table->foreignId("user_id")->constrained()->onDelete("cascade");
    $table->foreignId("order_id")->constrained()->onDelete("cascade");
    $table->date("cart_date")->default(date("Y-m-d"));
});


Capsule::schema()->enableForeignKeyConstraints();
?>