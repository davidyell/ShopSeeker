<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Postcodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:postcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and import postcode data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
