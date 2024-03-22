<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{

    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');
    }


    public function test_store_product_success()
    {
        // Arrange
        $productData = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100.00,
            'quantity' => 10,
        ];

        // Act:
        $response = $this->postJson(route('products.store'), $productData);

        // Assert:
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }


    public function test_update_product_success()
    {
        // Arrange
        $product = \App\Models\Product::factory()->create();

        $productData = [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => 200.00,
            'quantity' => 20,
        ];

        // Act:
        $response = $this->putJson(route('products.update', $product->id), $productData);

        // Assert:
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Updated Product']);
    }

    public function test_delete_product_success()
    {
        // Arrange
        $product = \App\Models\Product::factory()->create();

        // Act:
        $response = $this->deleteJson(route('products.destroy', $product->id));

        // Assert:
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
    public function test_get_all_products_success()
    {
        // Arrange
        \App\Models\Product::factory(5)->create();

        // Act:
        $response = $this->getJson(route('products.index'));

        // Assert:
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data.Products');
    }


    public function test_store_product_with_incomplete_data_failure()
    {
        // Arrange
        $productData = [
            'name' => 'Incomplete Product',
//            'price' => 50.00,
            'quantity' => 5,
        ];

        // Act
        $response = $this->postJson(route('products.store'), $productData);

        // Assert
        $response->assertStatus(422); // Assuming 422 for validation error

    }
    public function test_update_product_with_incomplete_data_failure()
    {
        // Arrange
        $product = \App\Models\Product::factory()->create();

        $productData = [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => 200.00,
//            'quantity' => 20,
        ];

        // Act:
        $response = $this->putJson(route('products.update', $product->id), $productData);

        // Assert:
        $response->assertStatus(422); // Assuming 422 for validation error

    }

    public function test_delete_nonexistent_product_failure()
    {
        // Arrange
        $nonExistentProductId = 999; // Assuming this ID doesn't exist

        // Act
        $response = $this->deleteJson(route('products.destroy', $nonExistentProductId));

        // Assert
        $response->assertStatus(404); // Assuming 404 for not found
    }






}
