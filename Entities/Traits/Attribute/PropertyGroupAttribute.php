<?php

namespace Modules\Product\Entities\Traits\Attribute;


trait PropertyGroupAttribute
{
    public function getStatusNameAttribute()
    {
        return self::statuses()[ $this->status ];
    }
}
