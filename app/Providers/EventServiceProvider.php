<?php

namespace App\Providers;

use App\Listeners\CartUpdateListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'cart.added' => [
            'App\Listeners\CartUpdateListener',
        ],
        'cart.updated' => [
            'App\Listeners\CartUpdateListener',
        ],
        'cart.removed' => [
            'App\Listeners\CartUpdateListener',
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
