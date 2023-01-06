<?php

namespace App\Http\Controllers;

use App\Models\CashoutTracking;
use App\Models\KasTracking;
use Illuminate\Http\Request;

class PublicKas extends Controller
{
    public function index()
    {
        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $kas = [];
        $i = 0;
        $end = null;

        foreach (KasTracking::all() as $key) {
            // if ($key->month == 12) {
            //     $firstMondayOfThisMonth = date('Y-m-d', strtotime('first Monday of ' . $month[$key->month - 1], strtotime(date('Y') . '-12-01')));
            // } else if ($key->month == 11) {
            //     $firstMondayOfThisMonth = date('Y-m-d', strtotime('first Monday of ' . $month[$key->month - 1], strtotime(date('Y') . '-11-01')));
            // } else if ($key->month == 10) {
            //     $firstMondayOfThisMonth = date('Y-m-d', strtotime('first Monday of ' . $month[$key->month - 1], strtotime(date('Y') . '-10-01')));
            // } else {
            //     $firstMondayOfThisMonth = date('Y-m-d', strtotime('first Monday of ' . $month[$key->month - 1], strtotime(date('Y') . '-0' . $key->month . '-01')));
            // }

            $start = date('Y-m-d', strtotime('first Monday of ' . $month[$key->month - 1], strtotime($key->created_at)));

            if ($key->week == 1) {
                if (!is_null($end)) {
                    $start = date('Y-m-d', strtotime($end));
                } else {
                    $start = date('Y-m-d', strtotime('first Monday of ' . $month[$key->month - 1], strtotime($key->created_at)));
                }
                $kas[$i++] = [
                    'name' => $key->name,
                    'start' => $start,
                    'end' => date('Y-m-d', strtotime('+7 days', strtotime($start))),
                ];
            } else if ($key->week == 2) {
                $start = date('Y-m-d', strtotime('+7 days', strtotime($start)));
                $kas[$i++] = [
                    'name' => $key->name,
                    'start' => $start,
                    'end' => date('Y-m-d', strtotime('+7 days', strtotime($start))),
                ];
            } else if ($key->week == 3) {
                $start = date('Y-m-d', strtotime('+14 days', strtotime($start)));
                $kas[$i++] = [
                    'name' => $key->name,
                    'start' => $start,
                    'end' => date('Y-m-d', strtotime('+7 days', strtotime($start))),
                ];
            } else if ($key->week == 4) {
                $start = date('Y-m-d', strtotime('+21 days', strtotime($start)));
                $end = date('Y-m-d', strtotime('+7 days', strtotime($start)));
                $kas[$i++] = [
                    'name' => $key->name,
                    'start' => $start,
                    'end' => $end,
                ];
            }
        }

        return view('Kas', [
            'title' => 'Pembayaran Kas | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'tripay_channel' => get_channel(),
            'data' => $kas
        ]);
    }
}