<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitmentRequest;
use App\Repositories\Contracts\IJob;
use App\Repositories\Contracts\IJobRecruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class JobRecruitmentController extends Controller
{

    protected $jobRecruitmentRepository;
    protected $jobRepository;

    public function __construct(
        IJobRecruitment $jobRecruitmentRepository,
        IJob $jobRepository
    ) {
        $this->jobRecruitmentRepository = $jobRecruitmentRepository;
        $this->jobRepository = $jobRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(RecruitmentRequest $request)
    {
        $job_id = $request->input('job_id');
        $job = $this->jobRepository->find($job_id);
        if (!isset($job)) {
            return [
                'status' => 500,
                'job_id' => $job_id,
                'title' => trans('base.warning'),
                'message' => trans('base.not_existed', ['item' => trans('base.job')]),
            ];
        }
        $data = $request->except('_token');
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $data['cv'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/cv/job/'. $job_id .'/', $file, $data['cv']);
        }
        $this->jobRecruitmentRepository->create($data);
        return [
            'status' => 200,
            'title' => trans('base.success'),
            'message' => trans('recruitment.application'),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $jobRecruitment = $this->jobRecruitmentRepository->find($id);
        if (!isset($jobRecruitment)) {
            return response()->json(
                [
                    'status' => '500',
                    'title' => trans('base.warning'),
                    "message" => trans('base.not_existed', ['item' => trans('base.recruitment')])
                ]
            );
        }
        $jobRecruitment->update(['read_at' => Date::now()]);
        return response()->json(
            [
                'status' => '200',
                'title' => trans('base.success'),
                'row_id' => $id,
                "message" => trans('base.update_success', ['item' => trans('base.recruitment_header')])
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $job = $this->jobRepository->find($id);
        if (!isset($job)) {
            return response()->json(
                [
                    'status' => '500',
                    'title' => trans('base.warning'),
                    'not_exist' => true,
                    'row_id' => $id,
                    "message" => trans('base.not_existed', ['item' => trans('base.job')])
                ]
            );
        }
        if ($request->input('disabled') == 'disabled') {
            return response()->json(
                [
                    'status' => '500',
                    'title' => trans('base.error'),
                    'not_exist' => false,
                    'row_id' => $id,
                    "message" => trans('base.delete_fail', ['item' => trans('base.recruitment_header')])
                ]
            );
        }
        Storage::deleteDirectory('public/cv/job/'. $id);
        $this->jobRecruitmentRepository->where('job_id', $id)->delete();
        return [
            'status' => 200,
            'title' => trans('base.success'),
            'message' => trans('base.delete_success', ['item' => trans('base.recruitment_header')])
        ];
    }

    public function list()
    {
        if (request()->ajax()) {
            return $this->jobRecruitmentRepository->datatable();
        }
        return view('front-end.admin.job_recruitment.index');
    }
}
