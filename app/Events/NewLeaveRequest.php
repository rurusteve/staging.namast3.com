<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewLeaveRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usernip;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($usernip)
    {
        $this->$usernip = $usernip;
        $this->message = "New request leave from {$usernip}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('new-leave-request');
//        return['new-leave-request'];
    }
}
