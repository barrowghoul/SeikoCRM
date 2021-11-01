<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CustomerTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el tiempo transcurrido en la solicitud de precliente';

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
     * @return int
     */
    public function handle()
    {        
        Customer::where('status', '<=', 2)
        ->where('approval_status', '=', 1)
        ->where('created_at', '<=', Carbon::now()->subMinutes(1)->toDateTimeString())
        ->update(['approval_status' => 2]);

        Customer::where('status', '<=', 2)
        ->where('approval_status', '=', 2)
        ->where('created_at', '<=', Carbon::now()->subMinutes(10)->toDateTimeString())
        ->update(['approval_status' => 3]);
    }
}
