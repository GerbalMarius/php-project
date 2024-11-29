<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("users");

Capsule::schema()->create("users", function (Blueprint $table) {
    $table->id();
    $table->string("name",80);
    $table->string("last_name",80);
    $table->string("email",80)->unique();
    $table->string("password",80);
    $table->date("birthdate");
    $table->string("telephone_number");
    $table->boolean("is_active")->default(true);
});
Capsule::schema()->enableForeignKeyConstraints();
?>