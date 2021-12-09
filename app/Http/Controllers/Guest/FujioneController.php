<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IWine;
use Illuminate\Http\Request;

class FujioneController extends Controller
{
    protected $wineRepository;

    public function __construct(IWine  $wineRepository)
    {
        $this->wineRepository = $wineRepository;
    }


    public function homepage()
    {
        $wines = $this->wineRepository->all();
        return view('front-end.guest.fujione.homepage',['wines' => $wines]);
    }
}
