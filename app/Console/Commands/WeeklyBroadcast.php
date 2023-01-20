<?php

namespace App\Console\Commands;

use App\Models\KasTracking;
use Illuminate\Console\Command;

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
        info("Cron Weekly Broadcast running at " . now());

        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $nama = ['Rahmat Wahyuma Akbar', 'Ayu Fatimah', 'Qurata Ayun', 'Muhammad Yusuf Andrika', 'Aditiya Wahyu Alex S'];
        $wa = ['6281225389903', '6285803660012', '6282340621224', '6282136067349', '6285669812501', '6281367647589'];

        // $nama = ['Rahmat Wahyuma Akbar', 'Aditiya Wahyu Alex S'];
        // $wa = ['6281225389903', '6281367647589'];


        for ($i = 0; $i < count($nama); $i++) {
            $kas = KasTracking::where('name', $nama[$i])->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', time())), date('Y-m-d', strtotime('last day of December', time()))])->orderBy('id', 'DESC')->first();

            if (empty($kas) || is_null($kas)) {
                if ($nama[$i] == 'Qurata Ayun') {
                    send_msg($wa[$i], "Halo kak {$nama[$i]}, kamu belum ada tracking pembayaran kas di https://kas.marimas.xyz nih.\nBayar yuk kakak maniez :)))");
                } else {
                    send_msg($wa[$i], "Halo kak {$nama[$i]}, kamu belum ada tracking pembayaran kas di https://kas.marimas.xyz nih.\nBayar yuk kak :)))");
                }
            } else {
                if ($nama[$i] == 'Qurata Ayun') {
                    send_msg($wa[$i], "Halo kak {$nama[$i]}, kamu terakhir bayar kas adalah bulan {$month[$kas->month - 1]} minggu ke-{$kas->week}.\nTeruskan rajin membayar kas ya kakak maniez :)))");
                } else {
                    send_msg($wa[$i], "Halo kak {$nama[$i]}, kamu terakhir bayar kas adalah bulan {$month[$kas->month - 1]} minggu ke-{$kas->week}.\nTeruskan rajin membayar kas ya kak :))");
                }
            }
        }

        return Command::SUCCESS;
    }
}