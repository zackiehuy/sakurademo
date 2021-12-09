<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Repositories\Contracts\IBranch;
use App\Repositories\Contracts\ICompany;
use App\Repositories\Contracts\IHotline;
use App\Repositories\Contracts\IJob;
use App\Repositories\Contracts\IJobCategory;
use App\Repositories\Contracts\IJobRecruitment;
use App\Repositories\Contracts\IRecruitmentCategory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    protected $jobRepository;
    protected $jobCategoryRepository;
    protected $brandRepository;
    protected $recruitmentCategoryRepository;
    protected $jobRecruitmentRepository;
    protected $hotlineRepository;
    protected $companyRepository;

    public function __construct(
        IJob $jobRepository,
        IJobCategory $jobCategoryRepository,
        IBranch $brandRepository,
        IRecruitmentCategory $recruitmentCategoryRepository,
        IJobRecruitment $jobRecruitmentRepository,
        IHotline $hotlineRepository,
        ICompany $companyRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->brandRepository = $brandRepository;
        $this->recruitmentCategoryRepository = $recruitmentCategoryRepository;
        $this->jobRecruitmentRepository = $jobRecruitmentRepository;
        $this->hotlineRepository = $hotlineRepository;
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->jobRepository->datatable();
        }
        return view('front-end.admin.job.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobCategories = $this->jobCategoryRepository->all();
        $branches = $this->brandRepository->all();
        $recruitmentAddress = $this->brandRepository->branchLocation();
        $recruitmentCategories = $this->recruitmentCategoryRepository->all();
        $hotlines = $this->hotlineRepository->all();
        $companies = $this->companyRepository->all();
        $neededObject = array_filter(
            json_decode($jobCategories),
            function ($e) {
                return $e->name_en == 'CEO';
            }
        );
        unset($jobCategories[key($neededObject)]);
        foreach ($companies as $company) {
            if ($company->branches_count == 0) {
                $branches->push($company);
            }
        }
        return view(
            'front-end.admin.job.create',
            [
                'jobCategories' => $jobCategories,
                'branches' => $branches,
                'recruitmentCategories' => $recruitmentCategories,
                'hotlines' => $hotlines,
                'recruitmentAddress' => $recruitmentAddress
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $data = $request->except(['_token','salary','branch_id','is_company']);
        if (isset($data['recruitment_category_id'])) {
            $data['recruitment_category_id'] = json_encode(array_keys($request['recruitment_category_id']));
        }
        $isBranch = $request->input('branch_id');
        if (strpos($isBranch, 'company_') !== false) {
            $data['company_id'] = str_replace('company_', '', $isBranch);
            $data['branch_id'] = null;
            if ($request->hasFile('image')) {
                //File Storage
                $file = $request->file('image');
                $data['image'] = time().'_'.$file->getClientOriginalName();
                Storage::putFileAs('public/images/job/', $file, $data['image']);
            }
        } else {
            $data['branch_id'] = $isBranch;
            $data['company_id'] = null;
            $data['image'] = null;
        }
        $job = $this->jobRepository->create($data);
        $job->url = $job->url . '-' . $job->id;
        $job->update();
        return redirect()->route('job.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.add_success', ['item' => trans('base.job_header')])
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
        $job = $this->jobRepository->find($id);
        if (request()->ajax()) {
                return $this->jobRecruitmentRepository->datatableRecruitment($id, $request);
        }
        if (!isset($job)) {
            return redirect()->route('job.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('base.job')])
                ]
            );
        }
        $end_date = strtotime($job->end_date);
        $now = strtotime(format_date(Date::now()));
        $job->disabled = 'disabled';
        if ($end_date < $now && $job->job_recruitments_count > 0) {
            $job->disabled = '';
        }
        $listJobRecruitment = $this->jobRecruitmentRepository->where('job_id', $id)->get();

        $job->hotline['contact'] = $job->hotline['phone'] . '(';
        if ($job->hotline['is_male'] == 1) {
            $job->hotline['contact'] .= 'Mr ';
        } else {
            $job->hotline['contact'] .= 'Mrs ';
        }
        $job->hotline['contact'] .= $job->hotline['name'] . ')';
        return view(
            'front-end.admin.job_recruitment.index',
            [
                'job' => $job,
                'listJobRecruitment' => $listJobRecruitment]
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
        $job = $this->jobRepository->find($id);
        if (!isset($job)) {
            return redirect()->route('job.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('base.job')])
                ]
            );
        }
        $hotlines = $this->hotlineRepository->all();
        $jobCategories = $this->jobCategoryRepository->all();
        $branches = $this->brandRepository->all();
        $recruitmentAddress = $this->brandRepository->branchLocation();
        $recruitmentCategories = $this->recruitmentCategoryRepository->all();
        $companies = $this->companyRepository->all();
        $neededObject = array_filter(
            json_decode($jobCategories),
            function ($e) {
                return $e->name_en == 'CEO';
            }
        );
        unset($jobCategories[key($neededObject)]);
        foreach ($companies as $company) {
            if ($company->branches_count == 0) {
                $branches->push($company);
            }
        }
        if (!isset($job->branch_id)) {
            $job->branch_id = 'company_' . $job->company_id;
        }
        return view(
            'front-end.admin.job.create',
            ['job' => $job,
                'jobCategories' => $jobCategories,
                'branches' => $branches,
                'recruitmentCategories' => $recruitmentCategories,
                'hotlines' => $hotlines,
                'recruitmentAddress' => $recruitmentAddress
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobUpdateRequest $request, $id)
    {
        $job = $this->jobRepository->find($id);
        if (!isset($job)) {
            return redirect()->route('job.index')->with(
                [
                    'flash_level'   => 'warning',
                    'flash_message' => trans('base.not_existed', ['item' => trans('base.job')])
                ]
            );
        }
        $data = $request->except(['_token','salary','branch_id','is_company']);
        $data['url'] = $request->input('url') . '-' . $job->id;
        if (isset($data['recruitment_category_id'])) {
            $data['recruitment_category_id'] = json_encode(array_keys($data['recruitment_category_id']));
        }
        $isBranch = $request->input('branch_id');
        if (strpos($isBranch, 'company_') !== false) {
            $data['company_id'] = str_replace('company_', '', $isBranch);
            $data['branch_id'] = null;
            if ($request->hasFile('image')) {
                //File Storage
                $file = $request->file('image');
                $data['image'] = time().'_'.$file->getClientOriginalName();
                Storage::putFileAs('public/images/job/', $file, $data['image']);
                if (isset($job['image'])) {
                    Storage::delete('public/images/job/'. $job['image']);
                }
            }
        } else {
            $data['branch_id'] = $isBranch;
            $data['company_id'] = null;
            $data['image'] = null;
            if (isset($job['image'])) {
                Storage::delete('public/images/job/'. $job['image']);
            }
        }
        $job->update($data);
        return redirect()->route('job.index')->with(
            [
                'flash_level' => 'success',
                'flash_message' => trans('base.update_success', ['item' => trans('base.job_header')])
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
        $end_date = strtotime($job->end_date);
        $now = strtotime(format_date(Date::now()));
        if ($job->job_recruitments_count > 0 && $end_date >= $now) {
            return response()->json(
                [
                    'status' => '500',
                    'title' => trans('base.error'),
                    'not_exist' => false,
                    'row_id' => $id,
                    "message" => trans('base.delete_fail', ['item' => trans('base.job_header')])
                ]
            );
        }
        Storage::deleteDirectory('public/cv/job/'. $id);
        $this->jobRecruitmentRepository->where('job_id', $id)->delete();
        $job->delete();
        return response()->json(
            [
                'status' => '200',
                'row_id' => $id,
                'title' => trans('base.success'),
                "message" => trans('base.delete_success', ['item' => trans('base.job_header')])
            ]
        );
    }

    public function recruitment()
    {
        $jobs = $this->jobRepository->all();
        return view('front-end.front-end.recruitment.index', ['jobs' => $jobs]);
    }

    public function recruitmentDetail($id)
    {
        $job = $this->jobRepository->find($id);
        if (!isset($job)) {
            return redirect()->route('recruitment')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('base.not_exists', ['item' => trans('base.job_header')])
            ]);
        }
        return view('front-end.front-end.recruitment.detail', ['job' => $job]);
    }
}
