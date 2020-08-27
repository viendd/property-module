<?php

namespace Modules\Product\Repositories\Cache;

use Illuminate\Cache\CacheManager;
use Modules\Core\Repositories\Cache\BaseCacheRepository;
use Modules\Product\Entities\Mongo\Brand;
use Modules\Product\Repositories\BrandRepository;
use Modules\Product\Repositories\Contracts\BrandRepositoryInterface;

class BrandCacheMongoRepository extends BaseCacheRepository implements BrandRepositoryInterface
{
    /**
     * ProductCategoryCacheRepository constructor.
     * @param Brand $brand
     * @param CacheManager $cache
     * @param BrandRepository $brandRepository
     */
    public function __construct(Brand $brand, CacheManager $cache, BrandRepository $brandRepository)
    {
        $this->model = $brand;
        $this->cache = $cache;
        parent::__construct($brandRepository);
    }

    public function setDataAdmin($params)
    {
        $params['source_db'] = config('mongo.source_db.central');
        $params['tenant_uid'] = null;
        $params['locale'] = app()->getLocale();
        return $params;
    }
}
