<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IBranch;

class SakuraController extends Controller
{

    protected $branchRepository;

    public function __construct(IBranch $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function maintenance()
    {
        return view('front-end.guest.sakura.maintenance');
    }

    public function guidingPrinciple()
    {
        return view('front-end.guest.sakura.guiding_principle');
    }

    public function executionOrder()
    {
        return view('front-end.guest.sakura.execution_order');
    }

    public function business()
    {
        return view('front-end.guest.sakura.business');
    }

    public function staff()
    {
        $list_branch = $this->branchRepository->branchLocation();
        return view('front-end.guest.sakura.staff', ['list_branch' => $list_branch]);
    }
}
