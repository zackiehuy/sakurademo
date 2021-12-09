<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'location_id' => 'required|exists:locations,id',
            'company_id' => 'required|exists:companies,id',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('base.name'),
            'address' => trans('base.address'),
            'location_id' => trans('base.location'),
            'phone' => trans('base.phone'),
            'email' => trans('base.email'),
            'company_id' => trans('base.company')
        ];
    }
}
