<?php

namespace App\Console\Commands;

use App\Models\Otp;
use Illuminate\Console\Command;

class OtpStatusCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:otp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron Status of OTP';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Cron OTP running at " . now());

        $d = date('Y-m-d H:i:s');
        $plus15Min = date("Y-m-d H:i:s", strtotime($d . ' +15 minutes'));

        info(Otp::where(['updated_at' > $plus15Min])->where('status', 'available')->count());

        return Command::SUCCESS;
    }
}