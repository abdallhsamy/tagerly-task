<?php

namespace App\Http\Resources\Vote;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VoteCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(fn($item) => [
            'rate' => $item->rate,
            'review' => $item->review,
//                'product_id' => $item->product_id,
            'user' => $item->user,
        ]);
    }
}
