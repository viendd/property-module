<?php

namespace Modules\Product\Entities\Mongo;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\Model;
use Modules\Product\Entities\Traits\Filterable\PropertySearchFilterable;
use Modules\Product\Entities\Traits\Scope\PropertyScope;

class Property extends Model
{
    use PropertyScope;
    const PATH_IMAGE = 'properties';
    /**
     * @var string
     */
    protected $connection = 'mongodb';
    /**
     * @var array
     */
    protected $fillable = ['source_db', 'tenant_uid', 'locale', 'name', 'property_group_id', 'brand_id', 'path_image'];

    const IMAGE = 'image';
    /**
     * @return BelongsTo
     */
    public function propertyGroup()
    {
        return $this->belongsTo(PropertyGroup::class, 'property_group_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
