<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
        // items table attributes: id, category_id, title, description, color, brand, serial_or_mark, image_url, created_at, updated_at

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'color',
        'brand',
        'serial_or_mark',
        'image_url',
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
