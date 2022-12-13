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

        foreach (Otp::where('status', 'available')->get() as $otp) {
            if (time() - strtotime($otp->updated_at) > (15 * 60)) {
                Otp::find($otp->id)->update(['status' => 'expire']);
            }
        }

        return Command::SUCCESS;
    }
}