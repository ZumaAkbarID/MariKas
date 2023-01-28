<?php

namespace App\Jobs;

use App\Models\KasTracking;
use App\Models\Payment;
use App\Models\PaymentTripay;
use App\Models\WConfig;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type, $id, $payment_type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $id, $payment_type = null)
    {
        $this->type = $type;
        $this->id = $id;
        $this->payment_type = $payment_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (WConfig::where('key', 'app_env')->first()->value == 'development') {
            return 1;
        }

        if ($this->type == 'payment') {
            if ($this->payment_type == 'manual') {
                $track = Payment::where('id', $this->id)->first();
                $text = "Halo " . $track->name . "\nPembayaran " . $track->trx_code . " sebesar Rp. " . number_format($track->amount, 0, ',', '.') . "\nBerstatus *" . $track->status . "*";
                return send_msg($track->phone_number, $text);
            } else {
                // Tripay
                $track = PaymentTripay::where('id', $this->id)->first();
                $text = "Halo " . $track->customer_name . "\nPembayaran " . $track->merchant_ref . " sebesar Rp. " . number_format($track->amount, 0, ',', '.') . "\nBerstatus *" . $track->status . "*";
                return send_msg($track->customer_phone, $text);
            }
        } elseif ($this->type == 'tracking') {
            $month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $track = KasTracking::where('id', $this->id)->first();
            $text = "Halo " . $track->name . "\nKas kamu bulan " . $month[$track->month - 1] . " minggu ke-" . $track->week . "\nDinyatakan *LUNAS*";
            return send_msg($track->phone_number, $text);
        }
    }
}