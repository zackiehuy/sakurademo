<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->group(function () {
    Auth::routes();
});
Route::group(['middleware' => ['get.menu']], function () {

    Route::get('lang/{language}', 'LangController@changeLanguage')->name('language');
    Route::group(['middleware' => ['role:admin'],'namespace' => 'Admin'], function () {
        Route::prefix('admin')->group(function () {
            //Dashboard
            Route::get('/', 'DashboardController@get')->name('dashboard.index');
            //Job
            Route::resource('/job', 'JobController');
            //Job Category
            Route::resource('/job-category', 'JobCategoryController')->except(['create', 'edit']);
            //Branch & Hotlines
            Route::get('/branch&hotline', 'BranchController@indexBranchHotline')->name('branch-hotline.index');
            Route::resource('/branch', 'BranchController')->except(['edit']);
            Route::get('/branch-hotlines/{branch_id}', 'BranchController@branchHotlines')->name('branch_hotlines');
            Route::get('/branch-employee', 'BranchController@branchEmployee')->name('branch_employee');
            Route::resource('/hotlines', 'HotlineController')->except(['create', 'edit']);
            //Recruitment
            Route::resource('/recruitment', 'JobRecruitmentController')->except(['index', 'show','store','destroy']);
            Route::delete('/recruitment/job/{id}', 'JobRecruitmentController@destroy');
            //Executive Board
            Route::resource('/executive-board', 'ExecutiveBoardController')->except(['create', 'edit']);
            //Company
            Route::resource('/companies', 'CompanyController')->except(['edit']);
            Route::get('/companies/list', 'CompanyController@list')->name('companies.list');
            //location + position
            Route::resource('/locations', 'LocationController');
            Route::resource('/positions', 'PositionController');
            //wines + news + users
            Route::resource('/wines', 'WineController')->except(['create', 'edit']);
            Route::post('/wines/new', 'WineController@newWine')->name('wines.new');
            Route::resource('/news', 'NewsController')->except(['edit']);
            Route::resource('/users', 'UserController')->except(['create', 'edit']);
            Route::post('/users/{id}/change-password', 'UserController@ChangePassword');
            //general setting
            Route::get('/general-settings', 'GeneralSettingController@get')->name('general-settings.get');
            Route::post('/general-settings', 'GeneralSettingController@post')->name('general-settings.post');
            //Document
            Route::get('/user-manual', function(){
                return view('front-end/admin/document/user_manual');
            });
        });
    });
    Route::group(['namespace' => 'Guest'], function () {
        //Dashboard
        Route::get('/', 'DashboardController@index')->name('homepage');
        //Sakura
        Route::get('/maintenance', 'SakuraController@maintenance')->name('sakura.maintenance');
        Route::get('/guiding-principles', 'SakuraController@guidingPrinciple')->name('sakura.guiding-principles');
        Route::get('/execution-order', 'SakuraController@executionOrder')->name('sakura.execution-order');
        Route::get('/business-activities', 'SakuraController@business')->name('sakura.business-activities');
        Route::get('/staff', 'SakuraController@staff')->name('sakura.staff');
        //Team 1000
        Route::get('/team-1000', 'Team1000Controller@homepage')->name('team1000.homepage');
        //Fuji one
        Route::get('/fuji-one', 'FujioneController@homepage')->name('fujione.homepage');
        //Recruitment
        Route::get('/recruitment', 'RecruitmentController@recruitment')->name('recruitment.index');
        Route::get('/recruitment/{url}', 'RecruitmentController@recruitmentDetail')->name('recruitment.detail');
        Route::post('/recruitment', 'RecruitmentController@store')->name('recruitment.store');
        //Contact us
        Route::get('/contact-us', 'ContactController@getContact')->name('contact.index');
        Route::post('/contact-us', 'ContactController@sendContact')->name('contact.send');
    });
    Route::get('404', function () {
        return view('404');
    })->name('404');
    Route::fallback(function ($request) {
        if (strpos($request, 'admin') > -1) {
            return redirect()->route('dashboard.index');
        } else {
            return view('404');
        }
    });
});
