<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Product\ProductCollection
     */
    public function index(ProductService $apiService)
    {
//        $products = $apiService->all();
        $products = app(Pipeline::class)
            ->send($apiService->all())
            ->through([
                \App\QueryFilters\Name::class,
                \App\QueryFilters\Price::class,
                \App\QueryFilters\VendorName::class,
            ])
            ->thenReturn();

        if (request()->has('sort') && in_array(request()->sort, ['price', 'most_selling', 'votes'])) {
                if(request()->sort === 'price' ) {

                    $products = $products->sortBy(function($product)
                    {
                        return $product->price;
                    });

                    if(request()->has('type') && request()->type === 'desc') {
                        $products = $products->reverse();
                    }
                } else if(request()->sort === 'most_selling') {
                    $products = $products->sortBy(function($product)
                    {
                        return $product->sold_times;
                    });
                    $products = $products->reverse();
                } else if(request()->sort === 'votes') {
                    $products = $products->sortBy(function($product)
                    {
                        return count($product->votes);
                    });
                    $products = $products->reverse();
                }
        }

        return new ProductCollection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
