<?php
require __DIR__ . "/../../config.php";
require __DIR__ . '/../../../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Models\Role;

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("roles");

Capsule::schema()->create("roles", function (Blueprint $table) {
    $table->id();
    $table->string("name",50)->unique();
    $table->text("description")->nullable();
});

Role::create(["name"=> "USER","description"=> "Regular user."]);
Role::create(["name"=> "MANAGER","description"=> "Product manager responsible for produce."]);
Role::create(["name"=> "ADMIN","description"=> "Administrator of the system."]);
Capsule::schema()->enableForeignKeyConstraints();
?>