<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class users extends Model
{
    use HasFactory;
    
protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'position',
    ];

    public static function getNumUsers()
    {
        $numUsers = users::count();
        return $numUsers;
    }
    // public function getFullNameAttribute()
    // {
    //    return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    // }
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
