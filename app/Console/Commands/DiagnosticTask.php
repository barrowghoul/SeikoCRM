<?php

namespace App\Console\Commands;

use App\Models\Diagnostic;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DiagnosticTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diagnostic:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el tiempo transcurrido en la creación y aprobación de los diagnósticos';

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
        Diagnostic::where('status', '=',Diagnostic::PENDING)
        ->where('approval_status', '=', 1)
        ->where('started_at', '<=', Carbon::now()->subHours(1)->toDateTimeString())
        ->update(['approval_status' => Diagnostic::EXPIRED]);
        return "Diagnostic Task ran";
    }
}
