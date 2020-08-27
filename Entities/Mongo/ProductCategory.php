<?php

namespace Modules\Product\Entities\Mongo;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class ProductCategory extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';
    /**
     * @var array
     */
    protected $fillable = ['source_db', 'tenant_uid',  'locale', 'is_feature', 'status', 'name', 'description'];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return HasMany
     */
    public function childs()
    {
        return $this->hasMany(ProductCategory::class, 'id', 'parent_id');
    }
}
