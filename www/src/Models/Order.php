<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = "orders";
    protected $fillable = ["date", "amount", "total_price"];

    public function status(){
        return $this->belongsTo(OrderStatus::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
?>