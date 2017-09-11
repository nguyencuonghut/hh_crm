<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('client-update');
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
            'client_code' => 'required',
            'province' => 'required',
            'district'=> 'required',
            'ward' => 'required',
            'company_service'=> 'required',
            'vat' => 'max:12',
            'address' => '',
            'zipcode' => 'max:6',
            'city' => '',
            'primary_number' => 'required|max:10',
            'secondary_number' => 'max:10',
            'industry_id' => 'required',
            'company_type' => '',
            'user_id' => 'required'
        ];
    }
}
