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

        return view('kas', [
            'title' => 'Pembayaran Kas | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'data' => $kas
        ]);
    }

    public function kas_eachmonth(Request $request)
    {
        if (!$request->bulan && !$request->tahun && !$request->nama) {
            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $kas = [];

            $kass = KasTracking::where('month', date('m'))->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', time())), date('Y-m-d', strtotime('last day of December', time()))])->get();

            if (empty($kass) || is_null($kass)) {
                $kas = [];
            } else {
                for ($i = 0; $i < count($kass); $i++) {
                    $kas[$i] = [
                        'name'      => $kass[$i]->name,
                        'week'      => $kass[$i]->week,
                        'paid_at'   => $kass[$i]->created_at
                    ];
                }
            }
        } else if ($request->bulan && !$request->tahun && !$request->nama) {
            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $kas = [];
            $findMonth = 0;
            for ($i = 0; $i < 12; $i++) {
                if ($request->bulan == $month[$i]) {
                    $findMonth = $i + 1;
                }
            }

            $kass = KasTracking::where('month', $findMonth)->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', time())), date('Y-m-d', strtotime('last day of December', time()))])->get();

            if (empty($kass) || is_null($kass)) {
                $kas = [];
            } else {
                for ($i = 0; $i < count($kass); $i++) {
                    $kas[$i] = [
                        'name'      => $kass[$i]->name,
                        'week'      => $kass[$i]->week,
                        'paid_at'   => $kass[$i]->created_at
                    ];
                }
            }
        } else if ($request->bulan && $request->tahun && !$request->nama) {
            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $kas = [];
            $findMonth = 0;
            for ($i = 0; $i < 12; $i++) {
                if ($request->bulan == $month[$i]) {
                    $findMonth = $i + 1;
                }
            }

            $kass = KasTracking::where('month', $findMonth)->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', strtotime($request->tahun . '-01-01'))), date('Y-m-d', strtotime('last day of December', strtotime($request->tahun . '-12-01')))])->get();

            if (empty($kass) || is_null($kass)) {
                $kas = [];
            } else {
                for ($i = 0; $i < count($kass); $i++) {
                    $kas[$i] = [
                        'name'      => $kass[$i]->name,
                        'week'      => $kass[$i]->week,
                        'paid_at'   => $kass[$i]->created_at
                    ];
                }
            }
        } else if ($request->bulan && !$request->tahun && $request->nama) {
            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $kas = [];
            $findMonth = 0;
            for ($i = 0; $i < 12; $i++) {
                if ($request->bulan == $month[$i]) {
                    $findMonth = $i + 1;
                }
            }

            $kass = KasTracking::where('month', $findMonth)->whereRaw('LOWER(`name`) LIKE ?', [$request->nama])->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', time())), date('Y-m-d', strtotime('last day of December', time()))])->get();

            if (empty($kass) || is_null($kass)) {
                $kas = [];
            } else {
                for ($i = 0; $i < count($kass); $i++) {
                    $kas[$i] = [
                        'name'      => $kass[$i]->name,
                        'week'      => $kass[$i]->week,
                        'paid_at'   => $kass[$i]->created_at
                    ];
                }
            }
        } else if ($request->bulan && $request->tahun && $request->nama) {
            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $kas = [];
            $findMonth = 0;
            for ($i = 0; $i < 12; $i++) {
                if ($request->bulan == $month[$i]) {
                    $findMonth = $i + 1;
                }
            }

            $kass = KasTracking::where('month', $findMonth)->whereRaw('LOWER(`name`) LIKE ?', [$request->nama])->whereBetween('created_at', [date('Y-m-d', strtotime('first day of January', strtotime($request->tahun . '-01-01'))), date('Y-m-d', strtotime('last day of December', strtotime($request->tahun . '-12-01')))])->get();

            if (empty($kass) || is_null($kass)) {
                $kas = [];
            } else {
                for ($i = 0; $i < count($kass); $i++) {
                    $kas[$i] = [
                        'name'      => $kass[$i]->name,
                        'week'      => $kass[$i]->week,
                        'paid_at'   => $kass[$i]->created_at
                    ];
                }
            }
        }

        return view('kas_eachmonth', [
            'title' => 'Kas | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'data' => $kas,
            'month' => $month
        ]);
    }
}