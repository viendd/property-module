<?php

namespace Modules\Product\Entities\Traits\Scope;

use Modules\Core\Entities\Traits\Filterable\NameFilterable;
use Modules\Core\Entities\Traits\Filterable\TranslationNameFilterable;
use Modules\Product\Entities\Traits\Filterable\PropertySearchFilterable;

trait PropertyScope
{
    use NameFilterable, PropertySearchFilterable;
}
