<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    //
    protected $fillable = [
        'post_id',
        'user_id',
        'claim_data',
        'verification_status',
        'verification_details'
    ];

    protected $casts = [
        'claim_data' => 'array',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
