<?php

namespace App\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function createProductCategory($validatedProductCategoryData)
    {
        return ProductCategory::create($validatedProductCategoryData);
    }

    public function getAllProductCategories()
    {
        return ProductCategory::all();
    }

    public function getProductCategory(ProductCategory $productCategory)
    {
        return $productCategory->load('products');
    }

    public function updateProductCategory($validatedProductCategoryData, ProductCategory $productCategory)
    {
        $productCategory->fill($validatedProductCategoryData);
        $productCategory->save();
        return $productCategory;
    }

    public function destroyProductCategory(ProductCategory $productCategory)
    {
        return $productCategory->delete();
    }
}
