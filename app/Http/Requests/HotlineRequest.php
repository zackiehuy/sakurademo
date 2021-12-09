<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotlineRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'is_male' => 'required|integer',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ];
        if ($this->request->get('branch_id') != "-1") {
            $rules['branch_id'] = 'nullable|exists:branches,id';
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => trans('base.name'),
            'is_male' => trans('base.gender'),
            'phone' => trans('base.phone'),
            'branch_id' => trans('base.branch')
        ];
    }
}
