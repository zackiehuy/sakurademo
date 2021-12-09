<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotlineRequest;
use App\Repositories\Contracts\IBranch;
use App\Repositories\Contracts\IHotline;
use Illuminate\Http\Request;

class HotlineController extends Controller
{

    protected $hotlineRepository;
    protected $branchRepository;

    public function __construct(IHotline $hotlineRepository, IBranch $branchRepository)
    {
        $this->hotlineRepository = $hotlineRepository;
        $this->branchRepository = $branchRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->hotlineRepository->datatable();
        }
        return redirect()->route('branch-hotline.index');
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
    public function store(HotlineRequest $request)
    {
        $data= $request->except('_token');
        $hotline_new = $this->hotlineRepository->create($data);
        $hotlines = $this->hotlineRepository->all();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                'data' => ['hotlines' => $hotlines, 'hotline_new' => $hotline_new],
                "message" => trans('base.add_success', ['item' => trans('base.hotline_header')])
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data = $this->hotlineRepository->find($id);
        if ($request->ajax()) {
            if (!isset($data)) {
                return response()->json(
                    [
                        'title' => trans('base.warning'),
                        'status' => '500',
                        'row_id' => $id,
                        "message" => trans('base.not_existed', ['item' => trans('base.hotline')])
                    ]
                );
            }
            return $data;
        }
        return redirect()->route('hotlines.index');
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
    public function update(HotlineRequest $request, $id)
    {
        $hotline = $this->hotlineRepository->find($id);
        if (!isset($hotline)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'status' => '500',
                    'row_id' => $id,
                    "message" => trans('base.not_existed', ['item' => trans('base.hotline')])
                ]
            );
        }
        $data = $request->except('_token');
        $hotline->update($data);
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                "message" => trans('base.update_success', ['item' => trans('base.hotline_header')])
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
        $hotline = $this->hotlineRepository->find($id);
        if (!isset($hotline)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'not_exist' => true,
                    'status' => '500',
                    "message" => trans('base.not_existed', ['item' => trans('base.hotline')])
                ]
            );
        }
        if ($hotline->jobs_count > 0) {
            return response()->json(
                [
                    'title' => trans('base.error'),
                    'not_exist' => false,
                    'status' => '500',
                    "message" => trans('base.delete_fail', ['item' => trans('base.hotline_header')])
                ]
            );
        }
        $hotline->delete();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                "message" => trans('base.delete_success', ['item' => trans('base.hotline_header')])
            ]
        );
    }
}
