<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchUpdateRequest extends FormRequest
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
            'name' => 'sometimes|required',
            'location_id' => 'sometimes|required|exists:locations,id',
            'company_id' => 'sometimes|required|exists:companies,id',
            'address' => 'sometimes|required',
            'phone' => 'sometimes|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'sometimes|required|email',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('base.name'),
            'address' => trans('base.address'),
            'phone' => trans('base.phone'),
            'email' => trans('base.email'),
            'company_id' => trans('base.company'),
            'location_id' => trans('base.location'),
        ];
    }
}
