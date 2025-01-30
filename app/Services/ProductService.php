<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function createProduct($validatedProductData)
    {
        return Product::create($validatedProductData);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProduct(Product $product)
    {
        return $product->load('category');
    }

    public function updateProduct($validatedProductData, Product $product)
    {
        $product->fill($validatedProductData);
        $product->save();
        return $product;
    }

    public function destroyProduct(Product $product)
    {
        return $product->delete();
    }
}
