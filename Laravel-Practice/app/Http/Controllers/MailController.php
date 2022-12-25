<?php

namespace App\Http\Controllers;

use App\Events\SomeOneVistProfile;
use App\Jobs\TestJobQueue;
use App\Mail\TestMailFunctionality;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    public function testMail()
    {
        $users = User::where('role', 'admin')->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new TestMailFunctionality($user));
        }
    }

    public function testJobsQueue()
    {
        $users = User::where('email', 'sheikhammar568@gmail.com')->get();
        foreach ($users as $user) {
            dispatch(new TestJobQueue($user))->delay(now()->addSeconds(10));
        }
    }

    public function testEventListners()
    {
        $user = User::inRandomOrder()->first();
        event(new SomeOneVistProfile($user));
    }

    public function testNotificationMail()
    {
        $user = User::where('role', 'admin')->first();
        Notification::send($user, new WelcomeNotification);
        dd("Notification Send");
    }
}
