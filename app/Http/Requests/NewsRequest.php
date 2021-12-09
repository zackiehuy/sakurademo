<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'jp.title' => 'required',
            'jp.abstract' => 'required',
            'vi.title' => 'required',
            'vi.abstract' => 'required',
            'en.title' => 'required',
            'en.abstract' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'jp.title' => trans('news.title'),
            'jp.abstract' => trans('base.image'),
            'vi.title' => trans('news.title'),
            'vi.abstract' => trans('base.image'),
            'en.title' => trans('news.title'),
            'en.abstract' => trans('base.image'),
            'abstract' => trans('news.abstract'),
            'content' => trans('news.content'),
        ];
    }
}
