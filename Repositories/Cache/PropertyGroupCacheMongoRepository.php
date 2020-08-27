<?php

namespace Modules\Product\Repositories\Cache;

use Illuminate\Cache\CacheManager;
use Modules\Core\Repositories\Cache\BaseCacheRepository;
use Modules\Product\Entities\Mongo\PropertyGroup;
use Modules\Product\Repositories\Contracts\PropertyGroupRepositoryInterface;
use Modules\Product\Repositories\PropertyGroupRepository;

class PropertyGroupCacheMongoRepository extends BaseCacheRepository implements PropertyGroupRepositoryInterface
{
    /**
     * ProductCategoryCacheRepository constructor.
     * @param PropertyGroup $propertyGroup
     * @param CacheManager $cache
     * @param PropertyGroupRepository $propertyGroupRepository
     */
    public function __construct(PropertyGroup $propertyGroup, CacheManager $cache, PropertyGroupRepository $propertyGroupRepository)
    {
        $this->model = $propertyGroup;
        $this->cache = $cache;
        parent::__construct($propertyGroupRepository);
    }

    public function setDataAdmin($params)
    {
        $params['source_db'] = config('mongo.source_db.central');
        $params['tenant_uid'] = null;
        $params['locale'] = app()->getLocale();
        return $params;
    }
}
