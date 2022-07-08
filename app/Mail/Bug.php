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


class Bug extends Mailable
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
        $user = DB::table('masteremployee')->where('nip', Auth::user()->nip)->first();
        return $this->view('emails.exception')
            ->with('content', $this->content)
            ->subject('Error '.$user->nip.' '.$user->nama.' '.$user->kota.' '.$user->grup);
    }
}
