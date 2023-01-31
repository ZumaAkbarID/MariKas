<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FastWAStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:fastwa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check every 2 mins FastWA API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (get_qr_code()['message'] !== 'Whatsapp instance connected successfully') {
            send_dc_webhook('custom', [
                [
                    'name' => 'Status',
                    'value' => 'Disconnected',
                    'inline' => false
                ],
                [
                    'name' => 'Server Time',
                    'value' => date('D d m Y H:i:s', strtotime(time())),
                    'inline' => false
                ],
            ], null, 'https://discordapp.com/api/webhooks/1070079814695915560/RMjiTyLnugFkt-iArOdawhtt0OagihEZI4zGkdhByMnTa__LQs8yajg2jBKC8ZMA3rY-');
        }

        return Command::SUCCESS;
    }
}