<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetDbName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Current Database Name';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dbName = DB::connection()->getDatabaseName();
        $this->info('The Current Database Name is: ' . $dbName);
    }
}
