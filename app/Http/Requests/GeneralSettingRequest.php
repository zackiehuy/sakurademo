<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
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
            'mail_username' => 'sometimes|required|email',
            'mail_password' => 'sometimes|required',
            'mail_manager' => 'sometimes|nullable|email',
            'phone_manager' => 'sometimes|nullable|required_with:mail_manager|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'name_manager' => 'sometimes|nullable|required_with:mail_manager',
        ];
    }

    public function attributes()
    {
        return [
            'mail_username' => trans('setting.mail_username'),
            'mail_password' => trans('setting.mail_password'),
            'mail_manager' => trans('setting.mail_manager'),
            'phone_manager' => trans('setting.phone_manager'),
            'name_manager' => trans('setting.name_manager'),
        ];
    }

    public function messages()
    {
        return [
            'phone_manager.required_with'  => trans('validation.required',['attribute' => trans('setting.phone_manager')]),
            'name_manager.required_with'  => trans('validation.required',['attribute' => trans('setting.name_manager')]),
        ];
    }
}
