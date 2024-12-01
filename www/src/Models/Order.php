<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = "orders";
    public $timestamps = false;
    protected $fillable = ["order_status_id","date", "amount", "total_price","user_id", "cart_id"];

    public static  $PLACED = 1;
    public static  $RESERVED = 2;
    public static  $APPROVED = 3;
    public static  $CANCELED = 4;

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