<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::where('email', 'kajan746+logintest@gmail.com')->get();
        if (count($user) == 0) {
            $registerResponse = $this->post('/api/register', ['name' => 'Kajan', 'email' => 'kajan746+logintest@gmail.com', 'password' => '12345678']);
        }
        $loginResponse = $this->post('/api/login', ['email' => 'kajan746+logintest@gmail.com', 'password' => '12345678']);
        $data = json_decode($loginResponse->getContent());
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$data->authorisation->token,
        ])->post('/api/quotation', [
            "age" => "28,35",
            "currency_id" => 2,
            "start_date" => "2020-10-01",
            "end_date" => "2020-10-30"
        ]);
        $response->assertJsonPath('data.total', '117.00')->assertStatus(200);
    }
}
