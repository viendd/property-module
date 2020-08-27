<?php

namespace Modules\Product\Entities\Traits\Methods;

trait PropertyGroupMethod
{
    public static function statuses()
    {
        return activeInactiveStatuses();
    }
}
