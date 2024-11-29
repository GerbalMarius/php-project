<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->dropIfExists("user_roles");

Capsule::schema()->create("user_roles", function (Blueprint $table) {
    $table->unsignedBigInteger("user_id");
    $table->unsignedBigInteger("role_id");

    // Explicitly define foreign keys with specific columns
    $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
    $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");

    // Composite primary key
    $table->primary(["user_id", "role_id"]);
});
?>