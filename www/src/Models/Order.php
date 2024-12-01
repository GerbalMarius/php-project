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

    public static function getTypeName($id){
        switch ($id){
            case 1:
                return "<p>PATEIKTAS</p>";
            case 2:
                return "<p style='color:blue;'>REZERVUOTAS</p>";
            case 3:
                    return "<p class='success'>PATVIRTINTAS</p>";
            case 4:
                return "<p style='color:red;'>ATŠAUKTAS</p>";
        }
    }

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