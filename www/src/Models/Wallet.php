<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {

    public $timestamps = false;
    
    protected $fillable = ["amount"];
    protected $table = "wallets";
}
?>