@extends('layouts.admin.master')

@section('title') {{ _t('edit') . ' ' . $propertyGroup->name }} @endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') {{ $propertyGroup->name }} @endslot
        @slot('li_1') {{ _t('home') }} @endslot
        @slot('li_2') {{ _t('edit') . ' ' . $propertyGroup->name }} @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ _t('edit') . ' ' . $propertyGroup->name }}</h4>

                    @include('common-components.forms.alert-error')

                    {!! Form::model($property,['route' => ['property-group.properties.update', [$propertyGroup->_id, $property->_id]],'method'=>'PATCH', 'class' => 'outer-repeater', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="id" value="{{$property->_id}}">
                    <div data-repeater-list="outer-group" class="outer">
                        @include('product::properties._form')
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit"
                                    class="btn btn-primary">{{ _t('edit') . ' ' . $propertyGroup->name }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
