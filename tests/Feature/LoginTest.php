<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::where('email', 'kajan746+logintest@gmail.com')->get();
        if (count($user)==0) {
            $registerResponse = $this->post('/api/register', ['name' => 'Kajan', 'email' => 'kajan746+logintest@gmail.com', 'password' => '12345678']);            
        }
        $response = $this->post('/api/login', ['email' => 'kajan746+logintest@gmail.com', 'password' => '12345678']);            
 
        $response->assertStatus(200);
    }
}
