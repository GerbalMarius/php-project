<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model{
    protected $table = "order_status";
    protected $fillable = ["name"];
    public $timestamps = false;
}

?>