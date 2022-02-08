<?php

namespace App\Listeners;

use App\Events\CallEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CallEventListener
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
     * @param  CallEvent  $event
     * @return void
     */
    public function handle(CallEvent $event)
    {
        //
    }
}
