<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PaymentTripay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Tripay extends Controller
{
    public function index()
    {
        $data = [
            'paid' => PaymentTripay::where('status', 'PAID')->get(),
            'unpaid' => PaymentTripay::where('status', 'UNPAID')->get(),
            'expired' => PaymentTripay::where('status', 'EXPIRED')->get(),
            'money_paid' => PaymentTripay::where('status', 'PAID')->sum('amount'),
            'money_unpaid' => PaymentTripay::where('status', 'UNPAID')->sum('amount'),
            'money_expired' => PaymentTripay::where('status', 'EXPIRED')->sum('amount'),
        ];

        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Pemilik.tripay', [
            'title' => 'Approval Pembayaran | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->orWhere('role', 'All')->limit(5)->get(),
            'data' => $data
        ]);
    }
}