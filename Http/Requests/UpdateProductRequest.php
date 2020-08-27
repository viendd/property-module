<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            localize_field('name')        => 'required',
            localize_field('caption')     => 'required',
            localize_field('description') => 'required',
            'brand_id'                    => 'required',
            'sku'                         => 'required',
            'regular_price'               => 'required|numeric',
            'sale_price'                  => 'nullable|numeric',
            'quantity'                    => 'required|numeric',
            'is_feature'                  => 'nullable',
            'status'                      => 'required',
            'feature-image'               => 'nullable',
            'detail-images'               => 'nullable',
            'shippable'                   => 'nullable',
            'downloadable'                => 'nullable',
            'categories'                  => 'required',
            'tags'                        => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
