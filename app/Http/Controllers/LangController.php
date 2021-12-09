<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function changeLanguage($language)
    {
        app()->setLocale($language);
        session()->put('language', $language);
        return redirect()->back();
    }
}
