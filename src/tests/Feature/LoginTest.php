<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_email_is_required() {

        $response = $this->post('/login',[
            'email' => '',
            'password' => 'password12345',
        ]);

        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
        $response->assertStatus(302);
    }

    public function test_password_is_required() {

        $response = $this->post('/login',[
            'email' => 'test@test.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
        $response->assertStatus(302);
    }

    public function test_login_fails_with_wrong_password(){

        $user = User::factory()->create([
            'email' => 'test1@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => 'test1@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません']);
        $this->assertGuest(); ;
    }

    public function test_user_can_login(){

        $user = User::factory()->create([
            'email' => 'test1@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => 'test1@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/'); 
        $this->assertAuthenticatedAs($user);
    }
}
