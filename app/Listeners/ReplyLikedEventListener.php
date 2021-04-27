<?php

namespace App\Listeners;

use App\Events\ReplyLikedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReplyLikedEventListener
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
     * @param  ReplyLikedEvent  $event
     * @return void
     */
    public function handle(ReplyLikedEvent $event)
    {
        //
    }
}
