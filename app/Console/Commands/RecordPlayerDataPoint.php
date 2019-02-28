<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RecordPlayerDataPoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:data-point';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record a data point for the specified user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
