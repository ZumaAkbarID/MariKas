<?php

namespace App\Jobs;

use App\Models\KasTracking;
use App\Models\Payment;
use App\Models\PaymentTripay;
use App\Models\User;
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

                if (WConfig::where('key', 'app_env')->first()->value == 'development') {
                    send_dc_webhook('custom', [
                        [
                            'name' => 'Nama',
                            'value' => $track->name,
                            'inline' => false
                        ],
                        [
                            'name' => 'NO WA',
                            'value' => $track->phone_number,
                            'inline' => false
                        ],
                        [
                            'name' => 'Type MSG',
                            'value' => 'Notif Wa, Payment Manual',
                            'inline' => false
                        ],
                        [
                            'name' => 'Text',
                            'value' => $text,
                            'inline' => false
                        ],
                        [
                            'name' => 'Status',
                            'value' => 'Send',
                            'inline' => false
                        ],
                    ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
                } else {
                    if (User::where('name', $track->name)->first()->notif_wa == 'Ya') {
                        return send_msg($track->phone_number, $text);
                    } else {
                        return 1;
                    }
                }
            } else {
                // Tripay Coming Soon
                $track = PaymentTripay::where('id', $this->id)->first();
                $text = "Halo " . $track->customer_name . "\nPembayaran " . $track->merchant_ref . " sebesar Rp. " . number_format($track->amount, 0, ',', '.') . "\nBerstatus *" . $track->status . "*";
                return send_msg($track->customer_phone, $text);
            }
        } else if ($this->type == 'tracking') {

            $month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            $track = KasTracking::where('id', $this->id)->first();

            $text = "Halo " . $track->name . "\nKas kamu bulan " . $month[$track->month - 1] . " minggu ke-" . $track->week . "\nDinyatakan *LUNAS*";

            if (WConfig::where('key', 'app_env')->first()->value == 'development') {
                send_dc_webhook('custom', [
                    [
                        'name' => 'Nama',
                        'value' => $track->name,
                        'inline' => false
                    ],
                    [
                        'name' => 'NO WA',
                        'value' => $track->phone_number,
                        'inline' => false
                    ],
                    [
                        'name' => 'Type MSG',
                        'value' => 'Tracking',
                        'inline' => false
                    ],
                    [
                        'name' => 'Text',
                        'value' => $text,
                        'inline' => false
                    ],
                    [
                        'name' => 'Status',
                        'value' => 'Send',
                        'inline' => false
                    ],
                ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
            } else {
                if (User::where('name', $track->name)->first()->notif_wa == 'Ya') {
                    return send_msg($track->phone_number, $text);
                } else {
                    return 1;
                }
            }
        }
    }
}
