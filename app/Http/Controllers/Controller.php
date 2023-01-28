<?php

namespace App\Http\Controllers;

use App\Models\WConfig;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $WConfig;
    public $tripay;
    public $fastwa;
    public $payment;

    public function __construct()
    {
        $this->WConfig = [
            'app_name' => WConfig::where('key', 'app_name')->first()->value,
            'app_favicon' => WConfig::where('key', 'app_favicon')->first()->value,
            'app_desc' => WConfig::where('key', 'app_desc')->first()->value,
            'app_banner' => WConfig::where('key', 'app_banner')->first()->value,
            'app_author' => WConfig::where('key', 'app_author')->first()->value,
        ];

        $this->tripay = [
            'api_key' => WConfig::where('key', 'tripay_api_key')->first()->value,
            'private_key' => WConfig::where('key', 'tripay_private_key')->first()->value
        ];

        $this->fastwa = [
            'instance_key' => WConfig::where('key', 'fastwa_instance_key')->first()->value,
        ];

        $this->payment = [
            'dana_holder_name' => WConfig::where('key', 'dana_holder_name')->first()->value,
            'dana_number' => WConfig::where('key', 'dana_number')->first()->value,
            'qris_url' => WConfig::where('key', 'qris_url')->first()->value,
        ];
    }
}