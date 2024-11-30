<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("orders");

Capsule::schema()->create("orders", function (Blueprint $table) {
    $table->id();

    $table->foreignId("order_status_id")->constrained()->cascadeOnDelete();

    $table->date("date")->default(date("Y-m-d"));
    $table->integer("amount");
    $table->decimal("total_price",10,2)->default(0);
    $table->foreignId("user_id")->constrained()->cascadeOnDelete();
});

Capsule::schema()->enableForeignKeyConstraints();
?>