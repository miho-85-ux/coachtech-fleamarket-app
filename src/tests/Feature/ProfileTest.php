<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_edit()
    {
        $response = $this->get('/mypage/profile');

        $response->assertStatus(302);
    }

    public function test_user_info_is_displayed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/mypage');

        $response->assertSee($user->name);
    }

    public function test_profile_edit_initial_values()
    {
        $user = User::factory()->create([
            'name' => 'テスト太郎',
            'postal_code' => '123-4567',
            'address' => 'Tokyo',
        ]);

        $response = $this->actingAs($user)->get('/mypage/profile');

        $response->assertSee('テスト太郎');
        $response->assertSee('123-4567');
    }
}
