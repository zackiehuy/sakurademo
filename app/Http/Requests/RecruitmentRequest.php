<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required||regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'cv' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('base.name'),
            'email' => trans('base.email'),
            'phone' => trans('base.phone'),
            'cv' => 'CV'
        ];
    }
}
