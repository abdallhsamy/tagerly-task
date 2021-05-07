<?php

namespace App\QueryFilters;

class Name extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->where('name','LIKE', "%" . request($this->filterName()) ."%");
    }
}
