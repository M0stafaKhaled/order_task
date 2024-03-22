<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login()
    {
        // Arrange
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
        ]);
        $credentials = [
            'email' => 'test@test.com',
            'password' => 'password',
        ];

        // Act
        $response = $this->postJson('/api/login', $credentials);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'access_token',
                'token_type',
                'expires_in',
            ],
        ]);
    }

    public function test_failed_login()
    {
        // Arrange
        $credentials = [
            'email' => 'test@test.com',
            'password' => 'wrong_password',
        ];

        // Act
        $response = $this->postJson('/api/login', $credentials);

        // Assert
        $response->assertStatus(401);
    }
}
