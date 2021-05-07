<?php

namespace App\QueryFilters;

class Price extends Filter
{
    protected function applyFilters($builder)
    {
        $str = request($this->filterName());

        if(strpos($str, ':') === false) {
            return $builder->where('price', '=', $str);
        }

        $min = explode(':', $str)[0];
        $max = explode(':', $str)[1];

        return $builder->whereBetween('price', [$min, $max]);

    }
}
