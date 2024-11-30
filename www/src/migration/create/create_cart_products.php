<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->disableForeignKeyConstraints();
Capsule::schema()->dropIfExists("cart_products");

Capsule::schema()->create("cart_products", function (Blueprint $table) {
    $table->unsignedBigInteger("cart_id");
    $table->unsignedBigInteger("product_id");


    $table->foreign("cart_id")->references("id")->on("carts")->onDelete("cascade");
    $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
    
    $table->integer("quantity")->default(1);
    $table->decimal("price",10,2)->default(0);

    $table->primary(["cart_id","product_id"]);
});

Capsule::schema()->enableForeignKeyConstraints();
?>