<?php

namespace Modules\Product\Entities\Mongo;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Jenssegers\Mongodb\Eloquent\Model;

class ProductTag extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';
    /**
     * @var array
     */
    protected $fillable = ['source_db', 'tenant_uid', 'name', 'status'];

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
