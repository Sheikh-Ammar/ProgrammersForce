<?php

namespace App\Listeners;

use App\Events\SomeOneVistProfile;
use App\Jobs\VisitProfileNotifyJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SomeOneVisitProfileNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SomeOneVisitProfile  $event
     * @return void
     */
    public function handle(SomeOneVistProfile $event)
    {
        $delay = now()->addSeconds(2);
        VisitProfileNotifyJob::dispatch($event->user)->delay($delay);
    }
}
