<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{

    // posts table attrubtes: 	id,	user_id, item_id, location_id, case_status, post_type, created_at, updated_at

    protected $fillable = [
        'user_id',
        'item_id',
        'location_id',
        'case_status',
        'post_type',
    ];

    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }

    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }

    public function claim(){
        return $this->hasMany(Claim::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
