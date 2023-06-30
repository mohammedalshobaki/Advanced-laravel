<?php

namespace App\Services;

use App\Events\Product\newProductMail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Review;
use \Illuminate\Support\Facades\Event;

class ProductsService
{
    public function __construct()
    {
    }

    public function getProducts()
    {
        return Product::with('reviews', 'details')->get();
    }

    public function getProduct(int $id)
    {
        return Product::query()->find($id);
    }

    public function createProduct($data)
    {
        $product = Product::query()->create($data);
        $product->details()->create($data);
        $product = $product->refresh();
        Event::dispatch(new newProductMail( $product));
        return $product;
    }

    public function updateProduct($id, $data)
    {
        $product = $this->getProduct($id);
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->user_id = $data['user_id'];
        $details = $product->details()->firstOrNew();
        $details->size = $data['size'];
        $details->color = $data['color'];
        $details->price = $data['price'];
        $details->save();
        $product->save();
        return $product;
    }

    public function deleteProduct(int $id)
    {
        $product = Product::find($id);

        if(!$product) return 0;

       $product->details()->delete();
       $product->reviews()->delete();
        $product->image()->delete();
        return $product->delete();
    }
}


