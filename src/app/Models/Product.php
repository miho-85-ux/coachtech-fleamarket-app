<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','brand','description','image','condition','color','status'];

    public function Categories() 
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
}
