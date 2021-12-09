<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IJob;

class DashboardController extends Controller
{

    protected $jobRepository;

    public function __construct(IJob $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function get()
    {
        $job = $this->jobRepository->getFirstRecruitment();
        return view('dashboard.homepage', ['job' => $job]);
    }
}
