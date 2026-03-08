<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends TestCase
{
   
    use RefreshDatabase;

    public function test_register_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
    
    public function test_name_is_required() {

        $response = $this->post('/register',[
            'name' => '',
            'email' => 'test@test.com',
            'password' => 'password12345',
            'password_confirmation' => 'password12345',
        ]);

        $response->assertSessionHasErrors(['name' => 'お名前を入力してください']);
        $response->assertStatus(302);
    }

    public function test_email_is_required() {

        $response = $this->post('/register',[
            'name' => 'テスト太郎',
            'email' => '',
            'password' => 'password12345',
            'password_confirmation' => 'password12345',
        ]);

        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
        $response->assertStatus(302);
    }

    public function test_password_is_required() {

        $response = $this->post('/register',[
            'name' => 'テスト太郎',
            'email' => 'test@test.com',
            'password' => '',
            'password_confirmation' => 'password12345',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
        $response->assertStatus(302);
    }
    
    public function test_password_must_be_at_least_8_chars() {

        $response = $this->post('/register',[
            'name' => 'テスト太郎',
            'email' => 'test@test.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
        $response->assertStatus(302);
    }

    public function test_password_confirmation_must_match() {

        $response = $this->post('/register',[
            'name' => 'テスト太郎',
            'email' => 'test@test.com',
            'password' => 'password12345!',
            'password_confirmation' => 'Different123!',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードと一致しません']);
        $response->assertStatus(302);
    }

    
        
    public function test_user_can_register(){
        Mail::fake();
        
        $email = 'test' . time() . '@example.com';

        $response = $this->post('/register', [
            'name' => 'テスト太郎',
            'email' => $email,
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

}
