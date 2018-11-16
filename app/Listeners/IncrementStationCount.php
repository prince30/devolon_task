<?php

namespace App\Listeners;

use App\Events\StationAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementStationCount
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
    public function handle(StationAdded $event)
    {
        $company=$event->station->company;
        $company->station_count=$company->station_count+1;
        $company->save();

        while($company->getParent()!=null)
        {
            $company=$company->getParent();
            if(!$company)
            {
                break;
            }
            $company->station_count=$company->station_count+1;
            $company->save();
        }
    }
}
