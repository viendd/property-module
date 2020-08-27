<?php

namespace Modules\Product\Entities\Traits\Methods;

trait ProductCategoryMethod
{
    public static function statuses()
    {
        return activeInactiveStatuses();
    }
}
