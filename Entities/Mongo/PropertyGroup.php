<?php

namespace Modules\Product\Entities\Mongo;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;
use Modules\Product\Entities\Traits\Attribute\PropertyGroupAttribute;
use Modules\Product\Entities\Traits\Methods\PropertyGroupMethod;
use Modules\Product\Entities\Traits\Scope\PropertyGroupScope;

class PropertyGroup extends Model
{
    use PropertyGroupMethod, PropertyGroupAttribute, PropertyGroupScope;
    /**
     * @var string
     */
    protected $connection = 'mongodb';
    /**
     * @var array
     */
    protected $fillable = ['source_db', 'tenant_uid', 'locale', 'name', 'status'];

    /**
     * @return HasMany
     */
    public function properties()
    {
        return $this->hasMany(Property::class, 'property_group_id');
    }
}
