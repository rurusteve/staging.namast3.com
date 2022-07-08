<?php

namespace App\Mail;

use App\LeaveRequest;
use App\MasterEmployee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DetectDevice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The body of the message.
     *
     * @var string
     */
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.detectdevice')
            ->with('content', $this->content)
            ->subject('Hi '.ucwords(strtolower(Auth::user()->name)).' theres a log in activity with your my.namast3 account recently, is that you?' );
    }
}
