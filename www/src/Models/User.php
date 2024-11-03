<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{
    protected $table = "users";

    protected $fillable = ["name", "last_name", "email", "password", "birthdate", "telephone_number", "is_active"];
}
?>
