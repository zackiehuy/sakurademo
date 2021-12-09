<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\Contracts\IExecutiveBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExecutiveBoardController extends Controller
{
    protected $executiveBoardRepository;

    public function __construct(IExecutiveBoard $executiveBoardRepository)
    {
        $this->executiveBoardRepository = $executiveBoardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->executiveBoardRepository->datatable();
        }
        return view('front-end.admin.executive_board.index');
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
    public function store(EmployeeRequest $request)
    {
        $data = $request->except(['_token']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/executive_board/', $file, $data['image']);
        }
        $this->executiveBoardRepository->create($data);
        return [
                'status' => 200,
                'title' => trans('base.success'),
                'message' => trans('base.add_success', ['item' => trans('base.executive_board_header')])
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
        $executiveBoard = $this->executiveBoardRepository->find($id);
        if ($request->ajax()) {
            if (!isset($executiveBoard)) {
                return [
                    'status' => 500,
                    'row_id' => $id,
                    'title' => trans('base.warning'),
                    'message' => trans('base.not_existed', ['item' => trans('base.executive_board')])
                ];
            }
            return $executiveBoard;
        }
        return redirect()->route('executive-board.index');
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
    public function update(EmployeeRequest $request, $id)
    {
        $executiveBoard = $this->executiveBoardRepository->find($id);
        if (!isset($executiveBoard)) {
            return [
                'status' => 500,
                'row_id' => $id,
                'title' => trans('base.warning'),
                'message' => trans('base.not_existed', ['item' => trans('base.executive_board')])
            ];
        }
        $data = $request->except(['_token']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/executive_board/', $file, $data['image']);
            if (isset($executiveBoard['image'])) {
                Storage::delete('public/images/executive_board/'.$executiveBoard['image']);
            }
        }
        $executiveBoard->update($data);
         return [
            'status' => 200,
             'title' => trans('base.success'),
            'row_id' => $id,
            'message' => trans('base.update_success', ['item' => trans('base.executive_board_header')])
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
        $executiveBoard = $this->executiveBoardRepository->find($id);
        if (!isset($executiveBoard)) {
            return [
                'status' => 500,
                'row_id' => $id,
                'title' => trans('base.warning'),
                'message' => trans('base.not_existed', ['item' => trans('base.executive_board')])
            ];
        }
        if (isset($executiveBoard['image'])) {
            Storage::delete('public/images/executive_board/'.$executiveBoard['image']);
        }
        $executiveBoard->delete();
        return [
            'status' => 200,
            'title' => trans('base.success'),
            'message' => trans('base.delete_success', ['item' => trans('base.executive_board_header')])
        ];
    }
}
