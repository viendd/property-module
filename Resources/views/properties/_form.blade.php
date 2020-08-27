<div data-repeater-item class="outer">
    @component('common-components.forms.text')
        @slot('field') name @endslot
        @slot('label') {{ _t('name') }} @endslot
        @slot('placeholder') {{ _t('enter') . ' ' . _t('name') . '...' }} @endslot
    @endcomponent


    <div class="form-group row mb-4">
        <label for=""
               class="col-form-label col-lg-2"></label>
        <div class="col-lg-10">
            <img src="{{ url(isset($property) ? asset('storage/'. $property->path_image) : noImage()) }}" width="120" height="120"/>
        </div>
    </div>

    @component('common-components.forms.file')
        @slot('field') image @endslot
        @slot('label') {{ _t('image') }} @endslot
        @slot('placeholder') {{ _t('enter') . ' ' . _t('image') . '...' }} @endslot
    @endcomponent

    @component('common-components.forms.select',[
        'options' => $brands,
        'props' => [],
    ])
        @slot('field') brand_id @endslot
        @slot('label') {{ _t('brand') }} @endslot
    @endcomponent
</div>
