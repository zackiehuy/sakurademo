<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IRecruitmentCategory;
use Illuminate\Http\Request;

class RecruitmentCategoryController extends Controller
{

    protected $recruitmentCategoryRepository;

    public function __construct(IRecruitmentCategory $recruitmentCategoryRepository)
    {
        $this->recruitmentCategoryRepository = $recruitmentCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->recruitmentCategoryRepository->datatable();
        }
        return view('front-end.admin.recruitment_category.index');
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
    public function store(Request $request)
    {
        $this->recruitmentCategoryRepository->create($request->except(['_token']));
        return redirect()->route('recruitment-category.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.add_success', ['item' => trans('base.recruitment_category')])
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recruitmentCategory = $this->recruitmentCategoryRepository->find($id);
        if (!isset($recruitmentCategory)) {
            return response()->json(
                [
                    'status' => '500',
                    'row_id' => $id,
                    "message" =>  trans('base.not_existed', ['item' => trans('base.recruitment_category')])
                ]
            );
        }
        return $recruitmentCategory;
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
    public function update(Request $request, $id)
    {
        $recruitmentCategory = $this->recruitmentCategoryRepository->find($id);
        if (!isset($recruitmentCategory)) {
            return redirect()->route('recruitment-category.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' =>  trans('base.not_existed', ['item' => trans('base.recruitment_category')])
                ]
            );
        }
        $recruitmentCategory->update($request->except(['_token','_method']));
        return redirect()->route('recruitment-category.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' =>  trans('base.update_success', ['item' => trans('base.recruitment_category')])
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recruitmentCategory = $this->recruitmentCategoryRepository->find($id);
        if (!isset($recruitmentCategory)) {
            return response()->json(
                [
                    'status' => '500',
                    "message" =>  trans('base.not_existed', ['item' => trans('base.recruitment_category')])
                ]
            );
        }
        $recruitmentCategory->delete();
        return response()->json(
            [
                'status' => '200',
                'row_id' => $id,
                "message" =>  trans('base.delete_success', ['item' => trans('base.recruitment_category')])
            ]
        );
    }
}
