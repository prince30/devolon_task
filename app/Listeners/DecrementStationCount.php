<?php

namespace App\Listeners;

use App\Events\StationRemoved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecrementStationCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(StationRemoved $event)
    {
        $company=$event->station->company;

        while($company != null&&$company->station_count > 0)
        {
            $company->station_count=$company->station_count - 1;
            $company->save();
            $company = $company->getParent();
        }
    }
}
