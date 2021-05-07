<?php

namespace App\Http\Resources\Product;

//use App\Http\Resources\Vendor\VendorResource;
use App\Http\Resources\Vote\VoteCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'price' => (float) $item->price,
//            'vendor_id' => $item->vendor_id,
            'sold_times' => $item->sold_times,
            'currency' => $item->currency,
            'vendor_name' => $item->vendor_name,
            'votes' => new VoteCollection($item->votes),
        ]);
    }
}
