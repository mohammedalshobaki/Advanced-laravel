<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ProductsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    protected $productService;
    protected $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = app(ProductsService::class);
        $this->product = [
            'title' => 'title from unit test343',
            'description' => 'Test desc',
            'user_id' => 1,
            'size' => 50,
            'color' => 'red'
        ];
    }

    public function test_create_product_without_auth()
    {
        $response = $this->withHeaders(['Accept'=>'application/json'])->post('/api/products', $this->product);

        $response->assertStatus(401);
    }

    public function test_create_product_without_data()
    {
        $response = $this->post('/api/products');

        $response->assertStatus(500);
    }

    public function test_create_product_with_auth()
    {
        $user = User::first();
        $response = $this->withHeaders(['Accept'=>'application/json'])
        ->actingAs($user)->post('/api/products');

        $response->assertStatus(406);
    }

    public function test_create_product_with_auth_success()
    {
        $user = User::where('email', 'mohammed@gmail.co')->first();

        $response = $this->withHeaders(['Accept'=>'application/json'])
        ->actingAs($user)->post('/api/products', $this->product);

        $response->assertStatus(200);
    }

    

}
