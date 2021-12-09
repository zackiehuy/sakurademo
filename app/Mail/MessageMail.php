<?php

namespace App\Mail;

use App\Repositories\Contracts\ISetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $setting;
    protected $contact;
    protected $branches;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($setting, $contact, $branches)
    {
        $this->setting = $setting;
        $this->contact = $contact;
        $this->branches = $branches;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.message_template', [
            'contact' => $this->contact,
            'setting' => $this->setting,
            'branches' => $this->branches,
            'logo' => $this->setting['image'] ?? '' ? Storage::url('images/setting/image/') . $this->setting['image'] : public_path("img/sakura.png"),
            'link' => url('/')
        ]);
    }
}
