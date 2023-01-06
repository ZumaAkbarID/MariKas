<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CashoutTracking;
use App\Models\KasTracking;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\PaymentTripay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{

    public function index()
    {
        // dd(Payment::select(
        //     DB::raw('SUM(amount) as money'),
        //     DB::raw("EXTRACT(YEAR FROM `created_at`) as year"),
        //     DB::raw("EXTRACT(MONTH FROM `created_at`) as mon")
        // )
        //     ->whereBetween('created_at', [date('Y') . '-01-01', date('Y') . '-12-31'])
        //     ->groupBy('mon', 'year')->get());

        $balance = [
            'manual_in' => Payment::where('status', 'approved')->sum("amount"),
            'manual_preview' => Payment::where('status', 'preview')->sum("amount"),
            'manual_rejected' => Payment::where('status', 'rejected')->sum("amount"),
            'tripay_in' => PaymentTripay::where('status', 'PAID')->sum("amount"),
            'tripay_unpaid' => PaymentTripay::where('status', 'UNPAID')->sum("amount"),
            'tripay_expired' => PaymentTripay::where('status', 'EXPIRED')->sum("amount"),
            'total_money_in' => PaymentTripay::where('status', 'PAID')->sum("amount") + Payment::where('status', 'approved')->sum("amount"),
            'total_money_out' => CashoutTracking::sum('amount')
        ];

        // Kas Masuk
        $kas_trackings = KasTracking::select(
            DB::raw('SUM(amount) as money'),
            DB::raw("EXTRACT(YEAR FROM `created_at`) as year"),
            DB::raw("EXTRACT(MONTH FROM `created_at`) as mon")
        )
            ->whereBetween('created_at', [date('Y') . '-01-01 00:00:01', date('Y') . '-12-31 23:59:59'])
            ->groupBy('mon', 'year')->get();

        $kas_tracking = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($kas_trackings as $kas) {
            $kas_tracking[$kas->mon - 1] = $kas->money;
        }

        // Kas Keluar
        $cashout_trackings = CashoutTracking::select(
            DB::raw('SUM(amount) as money'),
            DB::raw("EXTRACT(YEAR FROM `datetime`) as year"),
            DB::raw("EXTRACT(MONTH FROM `datetime`) as mon")
        )
            ->whereBetween('datetime', [date('Y') . '-01-01 00:00:01', date('Y') . '-12-31 23:59:59'])
            ->groupBy('mon', 'year')->get();

        $cashout_tracking = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($cashout_trackings as $cashout) {
            $cashout_tracking[$cashout->mon - 1] = $cashout->money;
        }

        $graphic = [
            'cashIn' => $kas_tracking,
            'cashOut' => $cashout_tracking
        ];

        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Dashboard.dashboard', [
            'title' => 'Dashboard | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->limit(5)->get(),
            'balance' => $balance,
            'graphic' => $graphic
        ]);
    }
}
