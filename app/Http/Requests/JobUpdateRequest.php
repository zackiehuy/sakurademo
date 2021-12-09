<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
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
            'branch_id' => 'sometimes|required',
            'job_category_id' => 'sometimes|required',
            'end_date' => 'sometimes|required|date',
            'is_fulltime' => 'sometimes|required',
            'salary' => 'sometimes|required',
            'description' => 'sometimes|required|nullable',
            'criteria' => 'sometimes|required|nullable',
            'benefit' => 'sometimes|required|nullable',
            'hotline_id' => 'sometimes|required|integer',
        ];
        //Check salary
        if ($this->request->get('salary') == 1) {
            $rules['salary_from'] = 'sometimes|required_if:salary_to,null';
            $rules['salary_to'] = 'sometimes|required_if:salary_from,null';
            if ($this->request->get('salary_from') != null && $this->request->get('salary_to') != null) {
                $salary_from = (int)str_replace(',', '', $this->request->get('salary_from'));
                $salary_to = (int)str_replace(',', '', $this->request->get('salary_to'));
                if ($salary_from > $salary_to) {
                    $rules['salary_from'] = 'required_if:salary_to,null|date';
                }
            }
        }
        if (strpos($this->request->get('branch_id'), 'company_') !== false || $this->request->get('branch_id') == null) {
            $company_id = str_replace('company_','',$this->request->get('branch_id'));
            $this->request->set('company_id',intval($company_id));
            $rules['company_id'] = 'exists:companies,id';
            $rules['recruitment_address'] = 'sometimes|required|integer';
        }
        else
        {
            $rules['branch_id'] = 'required|exists:branches,id';
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => trans('job.title'),
            'job_category_id' => trans('job.job_category'),
            'branch_id' => trans('base.company'),
            'company_id' => trans('base.company'),
            'end_date' => trans('job.end_date'),
            'description' => trans('job.description'),
            'salary' => trans('job.salary'),
            'is_fulltime' => trans('job.working_form'),
            'salary_from' => trans('job.salary_from'),
            'salary_to' => trans('job.salary_to'),
            'criteria' => trans('job.criteria'),
            'benefit' => trans('job.benefit'),
            'hotline_id' => trans('base.hotline'),
            'recruitment_address' => trans('job.recruitment_address')
        ];
    }

    public function messages()
    {
        return [
            'salary_from.required_if'  => trans('job.salary_required_if'),
            'salary_from.date'  => trans('job.salary_smaller')
        ];
    }
}
