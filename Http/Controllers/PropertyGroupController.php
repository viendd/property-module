<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Exceptions\RepositoryException;
use Modules\Core\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Product\Http\Requests\CreatePropertyGroupRequest;
use Modules\Product\Http\Requests\UpdatePropertyGroupRequest;
use Modules\Product\Repositories\Contracts\PropertyGroupRepositoryInterface;

class PropertyGroupController extends Controller
{
    protected $propertyGroup;

    public function __construct(PropertyGroupRepositoryInterface $propertyGroup)
    {
        $this->propertyGroup = $propertyGroup;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        $propertyGroups = $this->genPagination($request, $this->propertyGroup);
        return view('product::property-groups.index', compact('propertyGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('product::property-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreatePropertyGroupRequest $request
     * @return RedirectResponse
     * @throws RepositoryException
     */
    public function store(CreatePropertyGroupRequest $request)
    {
        $data = $this->propertyGroup->setDataAdmin($request->all());
        $this->propertyGroup->create($data);
        return redirect()->route('property-groups.index')->with(config('core.session_success'), _t('property-group') . ' ' . _t('create_success'));
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
     * @param int $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $property_group = $this->propertyGroup->find($id);
        return view('product::property-groups.edit', compact('property_group'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePropertyGroupRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdatePropertyGroupRequest $request, $id)
    {
        $property_group = $this->propertyGroup->find($id);
        $data = $this->propertyGroup->setDataAdmin($request->all());
        $this->propertyGroup->update($property_group, $data);
        return redirect()->route('property-groups.index')->with(config('core.session_success'), _t('property-group') . ' ' . _t('update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $property_group = $this->propertyGroup->find($id);
        $this->propertyGroup->delete($property_group);
        return redirect()->route('property-groups.index')->with(config('core.session_success'), _t('property-group') . ' ' . _t('delete_success'));
    }
}
