<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = "items";

    public $timestamps = false;
    protected $fillable = ["title", "manufacturer", "model", "category", "unit_price" , "discount"];
}