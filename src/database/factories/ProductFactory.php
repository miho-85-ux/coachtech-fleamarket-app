<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'seller_id' => User::factory(), 
            'name' => 'テスト商品',
            'price' => 1000,
            'description' => 'テスト用商品',
            'condition' => 'new',
            'status'  => 'selling',
        ];
    }
}
