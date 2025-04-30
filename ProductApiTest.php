<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function test_can_get_products_list()
    {
        Product::factory()->count(5)->create([
            'category_id' => $this->category->id
        ]);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'description', 'price', 'category']
                ]
            ]);
    }

    public function test_can_create_product()
    {
        Storage::fake('public');
        
        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99,
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('product.jpg')
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Test Product',
                    'price' => 99.99
                ]
            ]);

        Storage::disk('public')->assertExists('products/' . $response->json('data.image'));
    }
}