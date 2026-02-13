<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','brand','description','image','condition','color','status'];

    public function categories() 
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
        
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
