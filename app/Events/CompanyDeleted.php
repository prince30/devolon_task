<?php

namespace App\Events;

use App\Company;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CompanyDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $parent;
    public $count;

    /**
     * Create a new event instance.
     *
     * @param Company $company
     * @param $count
     */
    public function __construct($parent,$count)
    {
        $this->parent=$parent;
        $this->count=$count;
    }


}
