<?php

namespace App\Listeners;

use App\Events\CompanyDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class RecalculateCount
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
    public function handle(CompanyDeleted $event)
    {
       if($event->parent!=null) {
           $company=$event->parent;
           $count=$event->count;
           $company->station_count=$company->station_count-$count;
           $company->save();
           $company=$company->getParent();
           while($company!=null&&$company->station_count>0){
               $company->station_count=$company->station_count - $count;
               $company->save();
               $company=$company->getParent();
           }
       }
    }
}
