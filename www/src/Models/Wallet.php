<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {

    public $timestamps = false;
    
    protected $fillable = ["balance"];
    protected $table = "wallets";

    public function user() {
        return $this->belongsTo(User::class);
    }
}
?>