<?php

namespace App\Console\Commands;

use App\MasterEmployee;
use App\Statuses;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LockReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:lock-time-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To lock all time report in the period';

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
        $employees = MasterEmployee::all();
        foreach ($employees as $employee) {
            $status = new Statuses();
            $status->nip = $employee->nip;
            $status->period = Carbon::now()->format('m');
            $status->is_report_locked = true;

            $status->save();
        }
    }
}
