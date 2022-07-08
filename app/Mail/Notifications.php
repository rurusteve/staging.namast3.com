<?php

namespace App\Mail;

use App\LeaveRequest;
use App\MasterEmployee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class Notifications extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $leaverequest;
    public $nama;

    public function __construct(LeaveRequest $leaverequest)
    {
        $this->leaverequest = $leaverequest;
        $this->nama = DB::table('masteremployee')->where('nip', '=', $leaverequest->nip)->pluck('nama')->implode('nama');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notification@namast3.com')
            ->subject('Pengajuan Cuti dari '.ucwords(strtolower($this->nama)))
            ->view('emails.notification');
    }
}
