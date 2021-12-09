<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Repositories\Contracts\ICompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $companyRepository;

    public function __construct(ICompany $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companies = $this->companyRepository->datatable();
            return $companies;
        }
        return view('front-end.admin.company.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $companies = $this->companyRepository->all();
            return $companies;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front-end.admin.company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(CompanyCreateRequest $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $data['logo'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/companies/', $file, $data['logo']);
        }
        $new_company = $this->companyRepository->create($data);
        if ($request->ajax()) {
            $companies = $this->companyRepository->all();
            return [
                'status' => 200,
                'message' => trans('base.add_success', ['item' => trans('base.company_header')]),
                'title' => trans('base.success'),
                'companies' => $companies,
                'new_company' => $new_company
            ];
        }
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            $company = $this->companyRepository->find($id);
            if (!isset($company)) {
                return
                    [
                        'status' => 500,
                        'title'   => trans('base.warning'),
                        'message' => trans('base.not_existed', ['item' => trans('base.company')])
                    ];
            }
            return $company;
        }

        return view('front-end.admin.company');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $company = $this->companyRepository->find($id);
        if (!$company) {
            return [
                    'status' => 500,
                    'title' => trans('base.warning'),
                    'message' => trans('base.not_existed', ['item' => trans('base.company')])
                ];
        }
        $data = $request->except('_token');
        if ($request->hasFile('logo')) {
            if (isset($company['logo'])) {
                Storage::delete('public/images/companies/'. $company['logo']);
            }
            $file = $request->file('logo');
            $data['logo'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/companies/', $file, $data['logo']);
        }
        $company->update($data);
        return [
                'status' => 200,
                'title' => trans('base.success'),
                'message' => trans('base.update_success', ['item' => trans('base.company_header')])
            ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = $this->companyRepository->find($id);
        if (!isset($company)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'not_exist' => true,
                    'status' => '500',
                    "message" => trans('base.not_existed', ['item' => trans('base.company')])
                ]
            );
        }
        if ($company->branches_count + $company->jobs_count > 0 || in_array($id,array("1","2","3"))) {
            return response()->json(
                [
                    'title' => trans('base.error'),
                    'not_exist' => false,
                    'status' => '500',
                    "message" => trans('base.delete_fail', ['item' => trans('base.company_header')])
                ]
            );
        }
        if (isset($company['logo'])) {
            Storage::delete('public/images/companies/'. $company['logo']);
        }
        $company->delete();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                'row_id' => $id,
                "message" => trans('base.delete_success', ['item' => trans('base.company_header')])
            ]
        );
    }
}
