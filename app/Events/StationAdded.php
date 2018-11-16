<?php

namespace App\Events;

use App\Station;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StationAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $station;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Station $station)
    {
        $this->station=$station;
    }


}
