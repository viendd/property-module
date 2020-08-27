<?php

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Entities\Mongo\PropertyGroup;
use Modules\Product\Repositories\Contracts\PropertyGroupRepositoryInterface;

class PropertyGroupRepository extends BaseRepository implements PropertyGroupRepositoryInterface
{
    /**
     * ProductCategoryRepository constructor.
     * @param PropertyGroup $propertyGroup
     */
    public function __construct(PropertyGroup $propertyGroup)
    {
        $this->model = $propertyGroup;
    }
}
