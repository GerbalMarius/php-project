<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = "orders";
    public $timestamps = false;
    protected $fillable = ["date", "amount", "total_price","user_id", "cart_id"];

    public function status(){
        return $this->belongsTo(OrderStatus::class);
    }

    public function cart(){
       return $this->hasOne(Cart::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
?>