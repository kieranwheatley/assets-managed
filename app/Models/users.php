<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class users extends Model
{
    use HasFactory;
protected $appends = ['full_name'];

    public static function getNumUsers()
    {
        $numUsers = users::count();
        return $numUsers;
    }
    public function getFullNameAttribute()
    {
       return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}
