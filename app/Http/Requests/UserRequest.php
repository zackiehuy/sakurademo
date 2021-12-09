<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'username' => trans('user.username'),
            'email' => trans('user.email'),
            'password' => trans('user.password'),
            'password_confirmation' => trans('user.password_confirmation'),
        ];
    }
}
