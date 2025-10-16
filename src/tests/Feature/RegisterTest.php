<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    
    public function testRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $invalidData = [
            'name' => '',
            'email' => 'test@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];
        $response = $this->post('/register', $invalidData);
        $response->assertSessionHasErrors('name');

        $response->assertSessionHasErrors(['name' => 'お名前を入力してください']);
        
        $this->assertDatabaseMissing('users', [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect('/register');
    }
}
