<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingRequest;
use App\Repositories\Contracts\ISetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class GeneralSettingController extends Controller
{
    protected $settingRepository;
    protected $cost = ['vnd' => 'VND','usd' => 'USD','jpy' =>'JPY'];

    public function __construct(ISetting $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function get()
    {
        return view('front-end.admin.setting.setting', ['costs' => $this->cost]);
    }
    public function post(GeneralSettingRequest $request)
    {
        $setting = $this->settingRepository->all()->first();
        $data = $request->except('_token');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $data['logo'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/setting/logo/', $file, $data['logo']);
            if (isset($setting['logo'])) {
                Storage::delete('public/images/setting/logo/'. $setting['logo']);
            }
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = time().'_'.$file->getClientOriginalName();
            Storage::putFileAs('public/images/setting/image/', $file, $data['image']);
            if (isset($setting['image'])) {
                Storage::delete('public/images/setting/image/'. $setting['image']);
            }
        }

        file_put_contents(app()->environmentFilePath(), str_replace(
            'MAIL_USERNAME' . '=' . config('app.mail_username'),
            'MAIL_USERNAME' . '=' . $request->input('mail_username'),
            file_get_contents(app()->environmentFilePath())
        ));
        file_put_contents(app()->environmentFilePath(), str_replace(
            'MAIL_PASSWORD' . '=' . config('app.mail_password'),
            'MAIL_PASSWORD' . '=' . $request->input('mail_password'),
            file_get_contents(app()->environmentFilePath())
        ));

        $setting->update($data);
        Artisan::call('config:clear', [], null);

        return [
            'status' => 200,
            'title' => trans('base.success'),
            'message' => trans('base.update_success', ['item' => trans('setting.general_setting_header')])
        ];
    }
}
