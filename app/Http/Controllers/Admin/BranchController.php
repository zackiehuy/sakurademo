<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Repositories\Contracts\IBranch;
use App\Repositories\Contracts\ICompany;
use App\Repositories\Contracts\ILocation;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $branchRepository;
    protected $locationRepository;
    protected $companyRepository;

    public function __construct(
        IBranch $branchRepository,
        ILocation $locationRepository,
        ICompany $companyRepository
    ) {
        $this->branchRepository = $branchRepository;
        $this->locationRepository = $locationRepository;
        $this->companyRepository = $companyRepository;
    }

    public function indexBranchHotline()
    {
        return view('front-end.admin.branch.index');
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->branchRepository->datatable();
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
        $locations = $this->locationRepository->all();
        $companies = $this->companyRepository->all();
        return view('front-end.admin.branch.create', ['locations' => $locations, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            //File Storage
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/branch/', $file, $data['image']);
        }
        $this->branchRepository->create($data);
        return redirect()->route('branch.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.add_success', ['item' => trans('base.branch_header')])
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
        $data = $this->branchRepository->find($id);
        $locations = $this->locationRepository->all();
        $companies = $this->companyRepository->all();
        if (!isset($data)) {
            return redirect()->route('branch.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('branch.branch')])
                ]
            );
        }
        return view(
            'front-end.admin.branch.create',
            ['branch' => $data , 'locations' => $locations, 'companies' => $companies]
        );
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
    public function update(BranchUpdateRequest $request, $id)
    {
        $branch = $this->branchRepository->find($id);
        if (!isset($branch)) {
            return redirect()->route('branch.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('branch.branch')])
                ]
            );
        }
        $data = $request->except(['_method','_token']);
        if ($request->hasFile('image')) {
            //File Storage
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/branch/', $file, $data['image']);
            if (isset($branch['image'])) {
                Storage::delete('public/images/branch/'. $branch['image']);
            }
        }
        $branch->update($data);
        return redirect()->route('branch.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.update_success', ['item' => trans('base.branch_header')])
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
        $branch = $this->branchRepository->find($id);
        if (!isset($branch)) {
            return response()->json(
                [
                    'title' => trans('base.warning'),
                    'not_exist' => true,
                    'status' => '500',
                    "message" => trans('base.not_existed', ['item' => trans('branch.branch')])
                ]
            );
        }
        $count = $branch->executive_boards_count + $branch->hotlines_count + $branch->jobs_count;
        if ($count > 0) {
            return response()->json(
                [
                    'title' => trans('base.error'),
                    'not_exist' => false,
                    'status' => '500',
                    "message" => trans('base.delete_fail', ['item' => trans('base.branch_header')])
                ]
            );
        }
        if (isset($branch['image'])) {
            Storage::delete('public/images/branch/'. $branch['image']);
        }
        $branch->delete();
        return response()->json(
            [
                'title' => trans('base.success'),
                'status' => '200',
                'row_id' => $id,
                "message" => trans('base.delete_success', ['item' => trans('base.branch_header')])
            ]
        );
    }

    public function branchHotlines($branch_id)
    {
        return $this->branchRepository->branchHotlines($branch_id);
    }

    public function branchEmployee()
    {
        return $this->branchRepository->branchLocation();
    }
}
