<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcast
{
    public $memo;
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($memo)
    {
        $this->memo = $memo;
    }

    public function broadcastOn()
    {
        return new Channel('message');
    }
}
