<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class PurchaseTest extends TestCase
{
    public function test_purchase_page()
    {
        $response = $this->get('/purchase/1');

        $response->assertStatus(302);
    }

    public function test_shipping_address_reflected()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/purchase/address/1', [
            'shipping_postal_code' => '111-2222',
            'shipping_address' => 'Tokyo',
            'shipping_building' => 'Test',
        ]);

        $response = $this->actingAs($user)->get('/purchase/1');

        $response->assertSee('111-2222');
    }
   
    public function test_user_can_purchase_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->withSession([
            'purchase' => [
                'payment_method' => 1
            ],
            'shipping' => [
                'shipping_postal_code' => '123-4567',
                'shipping_address' => 'Tokyo',
                'shipping_building' => 'Test',
            ]
        ])->get("/purchase/success/{$product->id}");

        $this->assertDatabaseHas('orders', [
            'buyer_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    

    public function test_purchased_product_shows_in_profile()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        Order::create([
            'buyer_id' => $user->id,
            'product_id' => $product->id,
            'payment_method' => 1,
            'shipping_postal_code' => '123-4567',
            'shipping_address' => 'Tokyo',
            'shipping_building' => 'Test',
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertSee($product->name);
    }
}
