<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    public $timestamps = false;
    protected $fillable = ["name", "description"];


    public function users(){
        return $this->belongsToMany(User::class, "user_roles");
    }

    public static function extractName($role_id){
        switch ($role_id){
            case 1:
                return "Paprastas vartotojas";
            case 2:
                return "<p style='color:blue;'>Vadybininkas</p>";
            case 3:
                    return "<p class='success'>Adminstratorius</p>";
        }
    }
}

?>