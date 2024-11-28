<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = "items";

    public $timestamps = false;
    protected $fillable = ["title", "manufacturer", "model", "category", "image_data", "unit_price" , "discount", "total_units"];
}