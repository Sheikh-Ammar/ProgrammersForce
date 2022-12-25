<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FileCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filecount 
    {path : Enter Your Folder Name}
    {--F|--folder : Pass This if You Want To Count Sub Folders}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Count Files and Folders Of Given Path';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dir = base_path($this->argument('path')) . "/";
        $files = array_filter(glob($dir . "*"), "is_file") ?? 0;

        if ($this->option('folder')) {
            $folders = glob($dir . "*", GLOB_ONLYDIR) ?? 0;
            $this->info("Total "  . count($folders) . " Folders and " . count($files) . " Files");
        } else {
            $this->info("Total " . count($files) . " Files");
        }
    }
}
