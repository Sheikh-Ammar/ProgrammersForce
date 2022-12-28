<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use App\Mail\RegisterVerifyEmail;
use App\Mail\RegsiterVerifyEmail;
use App\Mail\TestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailRegisterUser
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
     * @param  \App\Events\RegisterUser  $event
     * @return void
     */
    public function handle(RegisterUser $event)
    {
        Mail::to($event->user->email)->send(new RegisterVerifyEmail($event->user, $event->userVerify));
    }
}
