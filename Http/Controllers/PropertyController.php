<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Product\Entities\Mongo\Property;
use Modules\Product\Http\Requests\CreatePropertyRequest;
use Modules\Product\Http\Requests\UpdatePropertyRequest;
use Modules\Product\Repositories\Contracts\BrandRepositoryInterface;
use Modules\Product\Repositories\Contracts\PropertyGroupRepositoryInterface;
use Modules\Product\Repositories\Contracts\PropertyRepositoryInterface;
use Modules\Product\Repositories\PropertyRepository;

class PropertyController extends Controller
{
    protected $property;
    protected $property_group;
    protected $brand;
    protected $property_no_cache;

    public function __construct(PropertyRepositoryInterface $propertyRepository, PropertyGroupRepositoryInterface $propertyGroupRepository, BrandRepositoryInterface $brandRepository, PropertyRepository $property_no_cache)
    {
        $this->property = $propertyRepository;
        $this->property_group = $propertyGroupRepository;
        $this->brand = $brandRepository;
        $this->property_no_cache = $property_no_cache;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param $property_group_id
     * @return Application|Factory|Response|View
     */
    public function index(Request $request,$property_group_id)
    {
        $propertyGroup = $this->property_group->findById($property_group_id);
        $properties = $this->property_no_cache->getProperties($propertyGroup, $request);
        return view('product::properties.index', compact('properties', 'propertyGroup'));
    }

    /**
     * Show the form for creating a new resource.
     * @param $property_group_id
     * @return Application|Factory|Response|View
     */
    public function create($property_group_id)
    {
        $brands = $this->brand->toArray('_id','name');
        $propertyGroup = $this->property_group->findById($property_group_id);
        return view('product::properties.create', compact('propertyGroup', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreatePropertyRequest $request
     * @param $property_group_id
     * @return RedirectResponse
     */
    public function store(CreatePropertyRequest $request, $property_group_id)
    {
        $property_group = $this->property_group->findById($property_group_id);
        $data = $this->property_no_cache->setDataAdmin($request->all());
        $property_group->properties()->create($data);
        return redirect()->route('property-group.properties.index',[$property_group_id])->with(config('core.session_success'), _t('property') . ' ' . _t('create_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $property_group_id
     * @param $property_id
     * @return Application|Factory|Response|View
     */
    public function edit($property_group_id, $property_id)
    {
        $propertyGroup = $this->property_group->findById($property_group_id);
        $property = $this->property->find($property_id);
        $brands = $this->brand->toArray('_id','name');
        return view('product::properties.edit', compact('property', 'propertyGroup', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePropertyRequest $request
     * @param $property_group_id
     * @param $property_id
     * @return RedirectResponse
     */
    public function update(UpdatePropertyRequest $request, $property_group_id, $property_id)
    {
        $property = $this->property->findById($property_id);
        $data = $this->property_no_cache->setDataAdmin($request->all(), $property_id);
        $this->property->update($property, $data);
        return redirect()->route('property-group.properties.index',[$property_group_id])->with(config('core.session_success'), _t('property') . ' ' . _t('update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $property_group_id
     * @param $property_id
     * @return RedirectResponse
     */
    public function destroy($property_group_id, $property_id)
    {
        $property = $this->property->find($property_id);
        $property->delete();
        return redirect()->route('property-group.properties.index',[$property_group_id])->with(config('core.session_success'), _t('property') . ' ' . _t('delete_success'));
    }
}
