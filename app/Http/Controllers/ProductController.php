<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(ProductService $apiService)
    {
        return new ProductCollection($apiService->all());
    }
}
