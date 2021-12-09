<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitmentRequest;
use App\Repositories\Contracts\IJob;
use App\Repositories\Contracts\IJobRecruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class RecruitmentController extends Controller
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

    public function recruitment(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->jobRepository->pagination(5);
            foreach ($data as $key => $value) {
                $end_date = strtotime($value->end_date);
                $now = strtotime(format_date(Date::now()));
                $data[$key]->salary = format_salary($value->salary_from, $value->salary_to);
                $data[$key]->url_detail = url('/recruitment/' . $value->url);
                $data[$key]->image = logo_job_company($value);
                $data[$key]->branch_name = branch_name($value);
                if ($end_date < $now) {
                    $data[$key]->end_date = 'Hết hạn';
                } else {
                    $data[$key]->end_date = 'Hết hạn ngày: '. format_date($value->end_date, 'd/m/Y');
                }
                if ($value->branch_id != null) {
                    $data[$key]->address = $value->branches->address;
                    $data[$key]->uri_address = map_address($value->branches->address);
                } else {
                    $data[$key]->address = $value->recruitmentAddress->address;
                    $data[$key]->uri_address = map_address($value->recruitmentAddress->address);
                }
            }
            return $data;
        }
        return view('front-end.guest.recruitment.index');
    }

    public function recruitmentDetail($url)
    {
        $job = $this->jobRepository->getWhere('url', '=', $url)->first();
        if (!isset($job)) {
            return view('404');
        } else {
            $end_date = strtotime($job->end_date);
            $now = strtotime(format_date(Date::now()));
            $job->salary = format_salary($job->salary_from, $job->salary_to);
            $job->end_date = 'Hết hạn ngày: '. format_date($job->end_date, 'd/m/Y');
            $job->url_detail = url('/recruitment/' . $job->url);
            if ($end_date < $now) {
                $job->disabled = 'disabled';
            } else {
                $job->disabled = '';
            }
            if ($job->branch_id != null) {
                $job->address = $job->branches->address;
                $job->uri_address = map_address($job->branches->address);
            } else {
                $job->address = $job->recruitmentAddress->address;
                $job->uri_address = map_address($job->recruitmentAddress->address);
            }
            $job->hotline_phone_show = substr($job->hotline->phone, 0, 4);
            $job->hotline_replace = str_pad('', strlen($job->hotline->phone) - 4, '*');
            $job->hotline_phone_hide = substr($job->hotline->phone, 4, strlen($job->hotline->phone) - 4);
            $contact = '';
            if ($job->hotline->is_male == 1) {
                $contact .= 'Mr ';
            } else {
                $contact .= 'Mrs ';
            }
            $name = explode(" ", $job->hotline->name);
            $job->hotline_name = $contact . $name[count($name) -1];
        }
        $same_jobs = $this->jobRepository->sameJob($url, $job->job_category_id)->take(3);
        foreach ($same_jobs as $key => $value) {
            $end_date = strtotime($value->end_date);
            $now = strtotime(format_date(Date::now()));
            $same_jobs[$key]->salary = format_salary($value->salary_from, $value->salary_to);
            $same_jobs[$key]->url_detail = url('/recruitment/' . $value->url);
            $same_jobs[$key]->image = logo_job_company($value);
            $same_jobs[$key]->branch_name = branch_name($value);
            if ($end_date < $now) {
                $same_jobs[$key]->end_date = 'Hết hạn';
            } else {
                $same_jobs[$key]->end_date = format_date($value->end_date, 'd/m/Y');
                $same_jobs[$key]->end_date = 'Hết hạn ngày: '. $value->end_date;
            }
            if ($value->branch_id != null) {
                $same_jobs[$key]->address = $value->branches->address;
                $same_jobs[$key]->uri_address = map_address($value->branches->address);
            } else {
                $same_jobs[$key]->address = $value->recruitmentAddress->address;
                $same_jobs[$key]->uri_address = map_address($value->recruitmentAddress->address);
            }
        }
        return view('front-end.guest.recruitment.detail', ['job' => $job,'same_jobs' => $same_jobs]);
    }
    public function store(RecruitmentRequest $request)
    {
        $job_id = $request->input('job_id');
        $job = $this->jobRepository->find($job_id);
        if (!isset($job)) {
            return [
                'status' => 500,
                'is_existed' => false,
                'title' => 'Cảnh báo',
                'message' => trans('base.not_existed', ['item' => trans('base.job')]),
                'url' => route('404'),
            ];
        }
        $end_date = strtotime($job->end_date);
        $now = strtotime(format_date(Date::now()));
        if ($end_date < $now) {
            return [
                'status' => 500,
                'is_existed' => true,
                'title' => 'Ứng tuyển không thành công',
                'message' => 'Tuyển dụng này đã quá hạn',
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
            'title' => 'Ứng tuyển thành công',
            'message' => '',
        ];
    }
}
