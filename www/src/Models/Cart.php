<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model{
    public $timestamps = false;
    protected $fillable = ["full_price","cart_date"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, "cart_product")
                                    ->withPivot("quantity", "price");
    }
}

?>