<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Jobs\SendContactEmail;
use App\Jobs\SendMessageEmail;
use App\Repositories\Contracts\IBranch;
use App\Repositories\Contracts\ISetting;

class ContactController extends Controller
{

    protected $settingRepository;
    protected $branchRepository;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ISetting $settingRepository, IBranch $branchRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->branchRepository = $branchRepository;
    }

    public function getContact()
    {
        return view('mail.contact');
    }

    public function sendContact(ContactRequest $request)
    {
        $contact = $request->except(['_token']);
        $setting = $this->settingRepository->all()->first();
        $branches = $this->branchRepository->all();
        ini_set('max_execution_time', 120);
        //Send mail
        SendContactEmail::dispatch($setting, $contact, $branches)->delay(now()->addMinutes(2));
        SendMessageEmail::dispatch($setting, $contact, $branches)->delay(now()->addMinutes(2));

        return redirect()->back()->with([
            'flash_level' => trans('base.success'),
            'flash_message' => 'Send contact successfully'
        ]);
    }
}
