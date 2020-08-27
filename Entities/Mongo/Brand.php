<?php

namespace Modules\Product\Entities\Mongo;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Brand extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';
    /**
     * @var array
     */
    protected $fillable = ['source_db', 'tenant_uid', 'name', 'is_feature', 'status'];

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
