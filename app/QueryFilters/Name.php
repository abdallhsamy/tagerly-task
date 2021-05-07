<?php

namespace App\QueryFilters;

class Name extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->filter(function ($item) {
            return stripos($item->name, request($this->filterName())) !== false;
        });
    }
}
