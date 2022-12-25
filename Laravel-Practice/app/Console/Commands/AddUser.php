<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a New User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask("What is your name ?");
        $email = $this->ask("What is your email ?");
        $password = $this->ask("What is your password ?");

        if ($this->confirm("Do You wish to continue ?" . true)) {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->save();
            $this->info($user->name . " Created Successfully !");
        } else {
            $this->warn("You Cancell To Create New User");
        }
    }
}
