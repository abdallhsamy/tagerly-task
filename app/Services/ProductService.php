<?php

namespace App\Services;

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

        return $collection;
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
