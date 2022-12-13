<?php

namespace App\Jobs;

use App\Models\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;
    protected $phone_number;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $phone_number)
    {
        $this->user_id = $user_id;
        $this->phone_number = $phone_number;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $otp_code = '';
        for ($i = 1; $i <= 6; $i++) {
            $otp_code .= substr("1357902468", (rand() % (strlen("1357902468"))), 1);
        }

        if (str_split($this->phone_number, 2)[0] == '08') {
            $n = explode("08", $this->phone_number);
            $this->phone_number = '628' . $n[1];
        }

        Otp::create([
            'user_id' => $this->user_id,
            'code' => $otp_code,
            'desc' => 'Aktivasi Akun',
            'phone_number' => $this->phone_number
        ]);

        $text = '
            Kode OTP : ' . $otp_code . '
        ';

        return send_msg($this->phone_number, $text);
    }
}