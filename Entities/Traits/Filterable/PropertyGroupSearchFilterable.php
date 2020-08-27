<?php

namespace Modules\Product\Entities\Traits\Filterable;

trait PropertyGroupSearchFilterable
{
    public function scopeSearch($query, $keyword)
    {
        return $query->name($keyword);
    }
}
