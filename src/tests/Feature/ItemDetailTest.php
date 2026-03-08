<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_detail()
    {
        $response = $this->get('/item/1');

        $response->assertStatus(500);
    }

    public function test_item_detail_page_displays_correct_information()
    {
        $seller = User::factory()->create();

        $category1 = Category::factory()->create(['name' => 'カテゴリA']);
        $category2 = Category::factory()->create(['name' => 'カテゴリB']);

        $product = Product::factory()->create([
            'seller_id' => $seller->id,
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト用商品説明',
            'condition' => 'new',
        ]);

        $product->categories()->attach([$category1->id, $category2->id]);

        $commenter = User::factory()->create();
        $product->comments()->create([
            'user_id' => $commenter->id,
            'content' => 'いい商品です！',
        ]);
       
        $response = $this->get("/item/{$product->id}");

        $response->assertSee('テスト商品');
        $response->assertSee('テストブランド');
        $response->assertSee('1,000');
        $response->assertSee('テスト用商品説明');
        $response->assertSee('new');
        
        $response->assertSee('カテゴリA');
        $response->assertSee('カテゴリB');
        
        $response->assertSee('いい商品です！');
        $response->assertSee($commenter->name);
    }      
}

