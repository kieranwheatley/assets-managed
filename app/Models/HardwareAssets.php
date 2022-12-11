<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareAssets extends Model
{
    use HasFactory;


    public function locationName()
    {
        return $this->hasOne(Locations::class, 'id', 'location');
    }
    public function assignedUser()
    {
        return $this->hasOne(User::class, 'id', 'users');
    }
}
