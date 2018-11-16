<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\StationAdded' => [
            'App\Listeners\IncrementStationCount',
        ],
        'App\Events\StationRemoved' => [
            'App\Listeners\DecrementStationCount',
        ],
        'App\Events\CompanyDeleted' => [
            'App\Listeners\RecalculateCount',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
