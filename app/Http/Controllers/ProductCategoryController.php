<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Http\Requests\ProductCategoryRequest;

use App\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{
    protected ProductCategoryService $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->productCategoryService->getAllProductCategories());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        $validatedProductCategoryData = $request->validated();
        return response()->json($this->productCategoryService->createProductCategory($validatedProductCategoryData));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return response()->json($this->productCategoryService->getProductCategory($productCategory));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $validatedData = $request->validated();
        return response()->json($this->productCategoryService->updateProductCategory($validatedData, $productCategory));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        return response()->json($this->productCategoryService->destroyProductCategory($productCategory));
    }
}
