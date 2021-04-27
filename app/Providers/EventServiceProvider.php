<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
// use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
// use App\Events\ReplyLikedEvent;
// use App\Listeners\ReplyLikedEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ReplyLikedEvent' => ['App\Listeners\ReplyLikedEventListener'],
        'App\Events\ReplyDeletedEvent' => ['App\Listeners\ReplyDeletedEventListener'],
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
