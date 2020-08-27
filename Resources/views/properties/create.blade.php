@extends('layouts.admin.master')

@section('title') {{ _t('create') . ' ' . $propertyGroup->name }} @endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') {{ $propertyGroup->name }} @endslot
        @slot('li_1') {{ _t('home') }} @endslot
        @slot('li_2') {{ _t('create') . ' ' . $propertyGroup->name }} @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ _t('create_new') . ' ' . $propertyGroup->name }}</h4>

                    @include('common-components.forms.alert-error')

                    {!! Form::open(['route' => ['property-group.properties.store', $propertyGroup->id],'method'=>'POST', 'class' => 'outer-repeater', 'enctype' => 'multipart/form-data']) !!}
                    <div data-repeater-list="outer-group" class="outer">
                        @include('product::properties._form')
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit"
                                    class="btn btn-primary">{{ _t('create') . ' ' . $propertyGroup->name }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
