<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{
    public $timestamps = false;
    protected $table = "users";

    protected $fillable = ["name", "last_name", "email", "password", "birthdate", "telephone_number", "is_active"];


    public function wallet(){
        return $this->hasOne(Wallet::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, "user_roles");
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
?>
