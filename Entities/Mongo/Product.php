<?php

namespace Modules\Product\Entities\Mongo;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';
    /**
     * @var array
     */
    protected $fillable = [
        'source_db', 'tenant_uid', 'locale', 'name', 'caption', 'description', 'status', 'shippable', 'downloadable',
        'regular_price', 'sale_price', 'quantity', 'sku', 'is_feature'
    ];

    /**
     * @return HasMany
     */
    public function propertyPrices()
    {
        return $this->hasMany(PropertyPrice::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }
}
