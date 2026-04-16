<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
            // locations table attributes: id, campus, building, room, notes, created_at, updated_at

    protected $fillable = [
        'campus',
        'building',
        'room',
        'notes',
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }
}
