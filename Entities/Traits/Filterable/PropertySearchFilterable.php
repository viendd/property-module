<?php

namespace Modules\Product\Entities\Traits\Filterable;

trait PropertySearchFilterable
{
    public function scopeSearch($query, $keyword)
    {
        return $query->name($keyword);
    }
}
