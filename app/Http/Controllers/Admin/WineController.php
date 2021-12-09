<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\NewWineRequest;
use App\Repositories\Contracts\IWine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WineController extends Controller
{

    protected $wineRepository;

    public function __construct(IWine $wineRepository)
    {
        $this->wineRepository = $wineRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->wineRepository->datatable();
        }
        return view('front-end.admin.wine.index');
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
    public function store(CompanyCreateRequest $request)
    {
        $data = $request->except(['_token']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/wines/', $file, $data['image']);
        }
        $wine = $this->wineRepository->create($data);
        $wine['code'] = 'A' . $wine['id'];
        $wine->update();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                "message" => trans('base.add_success', ['item' => trans('base.wine_header')])
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
        $wine = $this->wineRepository->find($id);
        if ($request->ajax()) {
            if (!isset($wine)) {
                return response()->json(
                    [
                        'status' => '500',
                        'title' => trans('base.warning'),
                        'row_id' => $id,
                        "message" => trans('base.not_existed', ['item' => trans('base.wine')])
                    ]
                );
            }
            return $wine;
        }
        return redirect()->route('wines.index');
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
    public function update(CompanyCreateRequest $request, $id)
    {
        $wine = $this->wineRepository->find($id);
        if (!isset($wine)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'status' => '500',
                    'row_id' => $id,
                    "message" => trans('base.not_existed', ['item' => trans('base.wine')])
                ]
            );
        }
        $data = $request->except(['_token']);
        $data['is_new'] = 0;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/wines/', $file, $data['image']);
            if (isset($wine['image'])) {
                Storage::delete('public/images/wines/'. $wine['image']);
            }
        }
        $wine->update($data);
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                "message" => trans('base.update_success', ['item' => trans('base.wine_header')])
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
        $wine = $this->wineRepository->find($id);
        if (!isset($wine)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'status' => '500',
                    "message" => trans('base.not_existed', ['item' => trans('base.wine')])
                ]
            );
        }
        if (isset($wine['image'])) {
            Storage::delete('public/images/wines/'. $wine['image']);
        }
        $wine->delete();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                'row_id' => $id,
                "message" => trans('base.delete_success', ['item' => trans('base.wine_header')])
            ]
        );
    }

    public function newWine(NewWineRequest $request)
    {
        $quantity = $request->input('quantity');
        $id = array();
        for ($i = 0; $i < $quantity; $i++) {
            $wine = $this->wineRepository->create(['is_new' => 1]);
            array_push($id,$wine['id']);
            $wine['code'] = 'A' . $wine['id'];
            $wine->update();
        }
        return [
            'status' => 200,
            'title' => trans('base.success'),
            'id' => $id,
            'message' => trans('base.add_success', ['item' => trans('base.wine_header')])
        ];
    }
}
