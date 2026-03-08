<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ItemListTest extends TestCase
{
    use RefreshDatabase;

    public function test_items_index()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function test_items_are_displayed()
    {
        
        $product = Product::factory()->create([
            'name' => 'テスト商品',
        ]); 

        $response = $this->get('/');

        $response->assertSee('テスト商品');
    }


    public function test_mylist_page()
    {
        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
    }

    public function test_item_can_be_searched_by_name()
    {
        $product1 = Product::factory()->create(['name' => 'テスト商品A']);
        $product2 = Product::factory()->create(['name' => '別の商品B']);

        $response = $this->get('/?name=テスト');

        $response->assertSee('テスト商品A');
        $response->assertDontSee('別の商品B');
    }

    public function test_search_in_mylist_tab()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['name' => 'テスト商品']);
        $product->likes()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/?tab=mylist&name=テスト');

        $response->assertSee('テスト商品');
    }

    
    
    
    
    public function test_mypage()
    {
        $response = $this->get('/mypage');

        $response->assertStatus(302);
    }

    
}
