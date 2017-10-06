<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('client-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'client_code' => '',
            'province' => 'required',
            'district'=> 'required',
            'ward' => 'required',
            'client_type_id' => 'required',
            'group_id' => 'required',
            'product_category_id'=> 'required',
            'vat' => 'max:12',
            'address' => '',
            'zipcode' => 'max:6',
            'city' => '',
            'primary_number' => 'required|max:10',
            'secondary_number' => 'max:10',
            'company_type' => '',
            'user_id' => 'required',
            'gs_tv_id' => 'required',
            'gd_vung_id' => 'required',
            'pgd_id' => 'required',
            'gd_id' => 'required'

        ];
    }
}
