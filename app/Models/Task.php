<?php


namespace app\Models;

use \Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package app\Models
 */

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['text', 'username', 'email', 'status', 'is_edited'];
    public $timestamps = false;
}
