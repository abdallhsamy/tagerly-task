<?php

namespace App\QueryFilters;

class VendorName extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->filter(function ($item) {
            return stripos($item->vendor_name, request($this->filterName())) !== false;
        });
    }
}
