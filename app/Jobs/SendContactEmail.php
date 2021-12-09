<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\ContactMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact;
    protected $setting;
    protected $branches;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($setting, $contact, $branches)
    {
        $this->contact = $contact;
        $this->setting = $setting;
        $this->branches = $branches;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->setting['mail_manager'])) {
            Mail::to($this->contact['email'])
                ->cc($this->setting['mail_manager'])
                ->send(new ContactMail($this->setting, $this->contact, $this->branches));
        } else {
            Mail::to($this->contact['email'])
                ->send(new ContactMail($this->setting, $this->contact, $this->branches));
        }
    }
}
