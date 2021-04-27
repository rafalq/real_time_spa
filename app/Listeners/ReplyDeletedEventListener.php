<?php

namespace App\Listeners;

use App\Events\ReplyDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReplyDeletedEventListener
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
     * @param  ReplyDeletedEvent  $event
     * @return void
     */
    public function handle(ReplyDeletedEvent $event)
    {
        //
    }
}
