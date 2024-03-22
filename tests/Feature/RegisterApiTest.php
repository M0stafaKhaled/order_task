<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // using AAA pattern
    public function test_success_register()
    {
        // Arrange
        $userData = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Act
        $response = $this->postJson('/api/register', $userData);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);
        $this->assertDatabaseCount('users', 1);
    }

    public function test_fails_register__without_name()
    {
        // Arrange
        $userData = [
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Act
        $response = $this->postJson('/api/register', $userData);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonStructure([
            "success" ,
            'message',
        ]);
    }

    public function test_fails_register_with_unmatched_password()
    {
        // Arrange
        $userData = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'different_password',
        ];

        // Act
        $response = $this->postJson('/api/register', $userData);

        // Assert
        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'The password confirmation does not match.',
        ]);
    }
    public function test_fails_register_with_invalid_email()
    {
        // Arrange
        $userData = [
            'name' => 'Test User',
            'email' => 'invalid_email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Act
        $response = $this->postJson('/api/register', $userData);

        // Assert
        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'The email must be a valid email address.',
        ]);
    }


}

