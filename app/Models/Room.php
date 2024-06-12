<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_number', 'facilities', 'description', 'images', 'price', 'available', 'owner_id', 'kos_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id'); 
    }

    public function kos()
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}
