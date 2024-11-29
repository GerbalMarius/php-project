<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    public $timestamps = false;
    protected $fillable = ["name", "description"];


    public function users(){
        return $this->belongsToMany(User::class, "user_roles");
    }
}

?>