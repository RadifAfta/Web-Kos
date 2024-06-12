<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'owner_id', 'capacity', 'images', 'phone', 'type', 'description'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
