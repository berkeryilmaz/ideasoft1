<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->productService->getAllProducts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validatedProductData = $request->validated();
        return response()->json($this->productService->createProduct($validatedProductData));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($this->productService->getProduct($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validatedProductData = $request->validated();
        return response()->json($this->productService->updateProduct($validatedProductData,$product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return response()->json($this->productService->destroyProduct($product));
    }
}
