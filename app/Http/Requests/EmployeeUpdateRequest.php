<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'en.name' => 'sometimes|required',
            'jp.name' => 'sometimes|required_without:vi.name',
            'vi.name' => 'sometimes|required_without:jp.name',
            'branch_id' => 'sometimes|required|integer',
            'job_category_id' => 'sometimes|required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'en.name' => trans('job_category.name_en'),
            'vi.name' => trans('job_category.name_vi'),
            'jp.name' => trans('job_category.name_jp'),
            'branch_id' => trans('base.location'),
            'job_category_id' => trans('executive_board.position')
        ];
    }
}
