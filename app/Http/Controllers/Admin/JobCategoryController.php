<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\JobCategoryRequest;
use App\Repositories\Contracts\IJobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{

    protected $jobCategoryRepository;

    public function __construct(IJobCategory $jobCategoryRepository)
    {
        $this->jobCategoryRepository = $jobCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->jobCategoryRepository->datatable();
        }
        return view('front-end.admin.job_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCategoryRequest $request)
    {
        $category_new = $this->jobCategoryRepository->create($request->except(['_token']));
        $categories = $this->jobCategoryRepository->all();
        return [
            'status' => '200',
            'title' => trans('base.success'),
            'message' => trans('base.add_success', ['item' => trans('base.job_category_header')]),
            'category_new' => $category_new,
            'categories' => $categories
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $jobCategory = $this->jobCategoryRepository->find($id);
        if ($request->ajax()) {
            if (!isset($jobCategory)) {
                return response()->json(
                    [
                        'status' => '500',
                        'title' => trans('base.warning'),
                        'row_id' => $id,
                        "message" => trans('base.not_existed', ['item' => trans('base.job_category')])
                    ]
                );
            }
            return $jobCategory;
        }
        return redirect()->route('job-category.index');
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
    public function update(JobCategoryRequest $request, $id)
    {
        $jobCategory = $this->jobCategoryRepository->find($id);
        if (!isset($jobCategory)) {
            return [
                    'status'   => '500',
                'title' => trans('base.warning'),
                    'message' => trans('base.not_existed', ['item' => trans('base.job_category')])
                ];
        }
        $jobCategory->update($request->except(['_token','_method']));
        return [
                'status' => '200',
            'title' => trans('base.success'),
                'message' => trans('base.update_success', ['item' => trans('base.job_category_header')])
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
        $jobCategory = $this->jobCategoryRepository->find($id);
        if (!isset($jobCategory)) {
            return response()->json(
                [
                    'status' => '500',
                    'not_exist' => true,
                    'row_id' => $id,
                    'title' => trans('base.warning'),
                    "message" => trans('base.not_existed', ['item' => trans('base.job_category')])
                ]
            );
        }
        if ($jobCategory->jobs_count + $jobCategory->executive_board_count > 0) {
            return response()->json(
                [
                    'status' => '500',
                    'not_exist' => false,
                    'row_id' => $id,
                    'title' => trans('base.error'),
                    "message" => trans('base.delete_fail', ['item' => trans('base.job_category_header')])
                ]
            );
        }
        $jobCategory->delete();
        return response()->json(
            [
                'status' => '200',
                'title' => trans('base.success'),
                'row_id' => $id,
                "message" => trans('base.delete_success', ['item' => trans('base.job_category_header')])
            ]
        );
    }
}
