<?php

namespace App\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function createProductCategory($data)
    {
        return ProductCategory::create($data);
    }

    public function getAllProductCategories()
    {
        return ProductCategory::all();
    }

    public function getProductCategory(ProductCategory $productCategory)
    {
        return $productCategory->load('products');
    }

    public function updateProductCategory($newProductCategory, ProductCategory $productCategory)
    {
        $productCategory->fill($newProductCategory);
        $productCategory->save();
        return $productCategory;
    }

    public function destroyProductCategory(ProductCategory $productCategory)
    {
        return $productCategory->delete();
    }
}
