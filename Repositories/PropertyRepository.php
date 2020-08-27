<?php

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Entities\Mongo\Property;
use Modules\Product\Repositories\Contracts\PropertyRepositoryInterface;
use Modules\Product\Traits\UploadImage;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    use UploadImage;
    /**
     * ProductCategoryRepository constructor.
     * @param Property $property
     */
    public function __construct(Property $property)
    {
        $this->model = $property;
    }

    public function setDataAdmin($params, $id = '')
    {
        if(isset($params['image'])) {
            if($id) {
                $path_image_old = $this->findById($id)->path_image;
                $this->deleteImage($path_image_old);
            }
            $image_path = $this->upload($params['image']);
            $params['path_image'] = $image_path;
        }
        $params['source_db'] = config('mongo.source_db.central');
        $params['tenant_uid'] = null;
        $params['locale'] = app()->getLocale();
        return $params;
    }

    public function upload($file)
    {
        return $this->uploadImage($file, Property::PATH_IMAGE);
    }

    public function getProperties($propertyGroup, $request){
        return $propertyGroup->properties()->when($search = $request->get('filter')['search'], function ($query, $search) {
            return $query->where('name','LIKE', "%{$search}%");
        })->get();
    }
}
