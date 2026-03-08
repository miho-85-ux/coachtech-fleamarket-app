<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class CommentTest extends TestCase
{
    
    public function test_user_can_comment()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post("/products/{$product->id}/comment", ['content' => 'いい商品です！',]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'content' => 'いい商品です！',
        ]);
    }

    public function test_guest_cannot_comment()
    {
        $product = Product::factory()->create();

        $response = $this->post("/products/{$product->id}/comment", [
            'content' => 'コメントです',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('comments', [
            'product_id' => $product->id,
            'content' => 'コメントです',
        ]);
    }

    public function test_comment_cannot_be_empty() {

        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post("/products/{$product->id}/comment", ['content' => '',  ]);

        $response->assertSessionHasErrors(['content']);
    }

    public function test_comment_must_be_within_255_characters() {

        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post("/products/{$product->id}/comment", ['content' => str_repeat('a', 256),  ]);

        $response->assertSessionHasErrors(['content']);
    }
}
