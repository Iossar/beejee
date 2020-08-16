<?php


namespace app\Models;
use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = false;

    public static function isAdmin()
    {
        return !empty($_SESSION['logged_user']) && $_SESSION['logged_user']->id == 1;
    }
}
