<?php

namespace Modules\Product\Repositories\Cache;

use Illuminate\Cache\CacheManager;
use Modules\Core\Repositories\Cache\BaseCacheRepository;
use Modules\Product\Entities\Mongo\Property;
use Modules\Product\Repositories\Contracts\PropertyRepositoryInterface;
use Modules\Product\Repositories\PropertyRepository;

class PropertyCacheMongoRepository extends BaseCacheRepository implements PropertyRepositoryInterface
{
    /**
     * ProductCategoryCacheRepository constructor.
     * @param Property $property
     * @param CacheManager $cache
     * @param PropertyRepository $propertyRepository
     */
    public function __construct(Property $property, CacheManager $cache, PropertyRepository $propertyRepository)
    {
        $this->model = $property;
        $this->cache = $cache;
        parent::__construct($propertyRepository);
    }
}
