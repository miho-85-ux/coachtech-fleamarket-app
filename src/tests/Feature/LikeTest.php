<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class LikeTest extends TestCase
{
    
    public function test_user_can_like_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post("/products/{$product->id}/like");

        $response->assertStatus(302);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_like_icon_changes_color_when_liked()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $product->likes()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/item/{$product->id}");

        $response->assertSee('ハートロゴ_ピンク'); 
    }

    public function test_user_can_unlike_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $like = $product->likes()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post("/products/{$product->id}/like");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }
}
