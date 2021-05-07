<?php

namespace App\Services;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
//            'Authorization' => $this->token,
    ];

    public function products()
    {
        $raw = $this->fetch('products');

        $collection = collect();
        foreach ($raw as $array) {
            $collection->add((object)$array);
        }

        return $collection;
    }

    public function sort($collection)
    {
        if (request()->has('sort') && in_array(request()->sort, ['price', 'most_selling', 'votes'])) {
            if(request()->sort === 'price' ) {

                $collection = $collection->sortBy(function($item)
                {
                    return $item->price;
                });

                if(request()->has('type') && request()->type === 'desc') {
                    $collection = $collection->reverse();
                }
            } else if(request()->sort === 'most_selling') {
                $collection = $collection->sortBy(function($item)
                {
                    return $item->sold_times;
                });

                $collection = $collection->reverse();

            } else if(request()->sort === 'votes') {

                $collection = $collection->sortBy(function($item)
                {
                    return count($item->votes);
                });

                $collection = $collection->reverse();
            }

            return $collection;
        }

    }

    public function all()
    {
        $raw = $this->fetch('relations');

        $collection = collect();

        foreach ($raw as $array) {
            $product = (Object) [
                'id' =>           $array['id'],
                'name' =>           $array['name'],
                'price' =>          (float) $array['price'],
                'vendor_id' =>      $array['vendor_id'],
                'sold_times' =>     $array['sold_times'],
                'currency' =>       $array['currency'],
                'vendor_name' =>    $array['vendor_name'],
            ];
            $product->votes = [];

            $votes = collect();

            foreach ($array['votes'] as $vote) {
                $votes->add((Object) $vote);
            }


            $product->votes = $votes;

            $collection->add($product);
        }

        return app(Pipeline::class)
            ->send($this->sort($collection))
            ->through([
                \App\QueryFilters\Name::class,
                \App\QueryFilters\Price::class,
                \App\QueryFilters\VendorName::class,
            ])
            ->thenReturn();
    }

    protected function fetch($uri = null)
    {
        $url = config('apiProducts.service_url');

        if ($uri) {
            $url .= '/' . $uri;
        }

        $response = Http::withHeaders($this->headers)->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        dispatch(function () use ($response) {
            Log::debug($response->json());
        })->afterResponse();

        return false;
    }

}
