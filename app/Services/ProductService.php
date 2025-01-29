<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProduct(Product $product)
    {
        return $product->load('category');
    }

    public function updateProduct($newProduct, Product $product)
    {
        $product->fill($newProduct);
        $product->save();
        return $product;
    }

    public function destroyProduct(Product $product)
    {
        return $product->delete();
    }
}
