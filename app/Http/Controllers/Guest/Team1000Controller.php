<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Team1000Controller extends Controller
{
    public function homepage()
    {
        return view('front-end.guest.team1000.homepage');
    }
}
