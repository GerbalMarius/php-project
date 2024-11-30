<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("products");

Capsule::schema()->create("products", function ( Blueprint $table) {
    $table->id();
    $table->string("title", 80);
    $table->string("manufacturer",80);
    $table->string("model",80);
    $table->string("category",60);
    $table->longText("image_data")->charset('binary');
    $table->decimal("unit_price",10,3);
    $table->decimal("discount",5,2);
    $table->integer("total_units");
});
Capsule::schema()->enableForeignKeyConstraints();

?>