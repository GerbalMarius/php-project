<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->dropIfExists("items");

Capsule::schema()->create("items", function ( $table) {
    $table->increments("id");
    $table->string("title", 80);
    $table->string("manufacturer",80);
    $table->string("model",80);
    $table->string("category",60);
    $table->longText("image_data")->charset('binary');
    $table->decimal("unit_price",10,3);
    $table->decimal("discount",5,2);
    $table->integer("total_units");
});

?>