<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyResetAntrian extends Command
{
    protected $signature = 'order:reset-queue';
    protected $description = 'Resets the order queue number daily';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::table('orders')->whereDate('created_at', '<', Carbon::today())->update(['antrian' => null]);

        $this->info('Order queue has been reset.');
    }
}
