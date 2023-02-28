<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class users extends Model
{
    use HasFactory;

    public static function getNumUsers()
    {
        $numUsers = users::count();
        return $numUsers;
    }
}
