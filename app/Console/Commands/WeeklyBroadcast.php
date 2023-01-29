<?php

namespace App\Console\Commands;

use App\Models\KasTracking;
use App\Models\User;
use App\Models\WConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class WeeklyBroadcast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly sent broadcast for pay kas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::channel('weeklyBroadcast')->info("Cron Weekly Broadcast running properly\n");

        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        for ($i = 0; $i < count(User::all()); $i++) {
            if (User::get()[$i]->broadcast == 'Ya') {
                $kas = KasTracking::where('name', User::get()[$i]->name)->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', time())), date('Y-m-d', strtotime('last day of December', time()))])->orderBy('id', 'DESC')->first();

                $phone_number = '';

                if (str_split(User::get()[$i]->phone_number, 2)[0] == '08') {
                    $n = explode("08", User::get()[$i]->phone_number);
                    $phone_number = '628' . $n[1];
                }

                if (empty($kas) || is_null($kas)) {
                    if (User::get()[$i]->name == 'Qurata Ayun') {
                        $txt = "Halo kak " . User::get()[$i]->name . ", kamu belum ada tracking pembayaran kas di https://kas.marimas.xyz nih.\nBayar yuk kakak maniez :)))";

                        if (WConfig::where('key', 'app_env')->first()->value == 'development') {
                            send_dc_webhook('custom', [
                                [
                                    'name' => 'Nama',
                                    'value' => User::get()[$i]->name,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'NO WA',
                                    'value' => $phone_number,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Type MSG',
                                    'value' => 'Broadcast',
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Text',
                                    'value' => $txt,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Status',
                                    'value' => 'Send',
                                    'inline' => false
                                ],
                            ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
                        } else {
                            send_msg($phone_number, $txt);
                        }
                    } else {
                        $txt = "Halo kak " . User::get()[$i]->name . ", kamu belum ada tracking pembayaran kas di https://kas.marimas.xyz nih.\nBayar yuk kak :)))";

                        if (WConfig::where('key', 'app_env')->first()->value == 'development') {
                            send_dc_webhook('custom', [
                                [
                                    'name' => 'Nama',
                                    'value' => User::get()[$i]->name,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'NO WA',
                                    'value' => $phone_number,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Type MSG',
                                    'value' => 'Broadcast',
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Text',
                                    'value' => $txt,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Status',
                                    'value' => 'Send',
                                    'inline' => false
                                ],
                            ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
                        } else {
                            send_msg($phone_number, $txt);
                        }
                    }
                } else {
                    if (User::get()[$i]->name == 'Qurata Ayun') {
                        $txt = "Halo kak " . User::get()[$i]->name . ", kamu terakhir bayar kas adalah bulan {$month[$kas->month - 1]} minggu ke-{$kas->week}.\nTeruskan rajin membayar kas ya kakak maniez :)))";

                        if (WConfig::where('key', 'app_env')->first()->value == 'development') {
                            send_dc_webhook('custom', [
                                [
                                    'name' => 'Nama',
                                    'value' => User::get()[$i]->name,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'NO WA',
                                    'value' => $phone_number,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Type MSG',
                                    'value' => 'Broadcast',
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Text',
                                    'value' => $txt,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Status',
                                    'value' => 'Send',
                                    'inline' => false
                                ],
                            ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
                        } else {
                            send_msg($phone_number, $txt);
                        }
                    } else {
                        $txt = "Halo kak " . User::get()[$i]->name . ", kamu terakhir bayar kas adalah bulan {$month[$kas->month - 1]} minggu ke-{$kas->week}.\nTeruskan rajin membayar kas ya kak :))";

                        if (WConfig::where('key', 'app_env')->first()->value == 'development') {
                            send_dc_webhook('custom', [
                                [
                                    'name' => 'Nama',
                                    'value' => User::get()[$i]->name,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'NO WA',
                                    'value' => $phone_number,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Type MSG',
                                    'value' => 'Broadcast',
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Text',
                                    'value' => $txt,
                                    'inline' => false
                                ],
                                [
                                    'name' => 'Status',
                                    'value' => 'Send',
                                    'inline' => false
                                ],
                            ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
                        } else {
                            send_msg($phone_number, $txt);
                        }
                    }
                }
            } else {
                send_dc_webhook('custom', [
                    [
                        'name' => 'Nama',
                        'value' => User::get()[$i]->name,
                        'inline' => false
                    ],
                    [
                        'name' => 'Type MSG',
                        'value' => 'Broadcast',
                        'inline' => false
                    ],
                    [
                        'name' => 'Status',
                        'value' => 'Skip, Broadcast == Tidak',
                        'inline' => false
                    ],
                ], null, 'https://discordapp.com/api/webhooks/1069304620142309457/giodWchLVuneBtplbh0OycKO10QHbcTqVlB5uimT684gYU0JvfL_InHiqZegQR0fX9_W');
            }
        }

        return Command::SUCCESS;
    }
}
