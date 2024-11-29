<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model{
    protected $table = "order_status";
    protected $fillable = ["status_name"];
    public $timestamps = false;
}

?>