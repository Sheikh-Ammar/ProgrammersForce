<?php

namespace App\Listeners;

use App\Events\VerifyEmailEvent;
use App\Mail\VerifyEmailMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class VerifyEmailProvider
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
     * @param  \App\Events\VerifyEmailEvent  $event
     * @return void
     */
    public function handle(VerifyEmailEvent $event)
    {
        Mail::to($event->user->email)->send(new VerifyEmailMail($event->user));
    }
}
