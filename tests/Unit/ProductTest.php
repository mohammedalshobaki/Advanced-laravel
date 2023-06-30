<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ProductsService;

class ProductTest extends TestCase
{
    protected $productService;
    protected $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = app(ProductsService::class);
        $this->product = [
            'title' => 'title from unit test',
            'description' => 'Test desc',
            'user_id' => 1,
            'size' => 50,
            'color' => 'red'
        ];
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_product_in_db()
    {
        $this->productService->createProduct($this->product);
        $this->assertDatabaseHas('products', [
            'title' => 'title from unit test',
        ]);
    }
}
