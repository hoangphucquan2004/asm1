<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'slug',
        'image',
        'title',
        'content',
        'is_active',
        'is_hot',
        'is_show_home',
        'is_new',
    ];

    protected $casts = [
        'is_active',
        'is_hot',
        'is_show_home',
        'is_new',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
