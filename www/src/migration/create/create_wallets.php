<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("wallets");

Capsule::schema()->create("wallets", function (Blueprint $table) {
    $table->id();

    $table->decimal("balance",10,2)->default(0);

    $table->foreignId("user_id")->constrained()->onDelete("cascade");
});
Capsule::schema()->enableForeignKeyConstraints();
?>