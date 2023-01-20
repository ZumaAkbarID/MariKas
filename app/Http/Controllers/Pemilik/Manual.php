<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatus;
use App\Models\KasTracking;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Manual extends Controller
{
    public function form()
    {
        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Pemilik.manual', [
            'title' => 'Pembayaran Manual | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->limit(5)->get(),
        ]);
    }

    public function process(Request $request)
    {
        $nama = ['Aditiya Wahyu Alex S', 'Niken Lismiati', 'Muhammad Yusuf Andrika', 'Qurata Ayun', 'Rahmat Wahyuma Akbar', 'Ayu Fatimah'];
        $namaFound = 0;
        for ($i = 0; $i < count($nama); $i++) {
            if ($nama[$i] == $request->name) {
                $namaFound = 1;
            }
        }

        if ($namaFound == 0) {
            return redirect()->back()->with('error', 'Apakah dia (' . $request->name . ') anggota Marimas? ');
        }

        $phone_number = '';
        if (str_split($request->phone_number, 2)[0] == '08') {
            $n = explode("08", $request->phone_number);
            $phone_number = '628' . $n[1];
        } else {
            $phone_number = $request->phone_number;
        }

        $amount = $request->amount * 10000;
        $trx_code = 'MARIKAS-MAN-' . time();

        $data = [
            'trx_code' => $trx_code,
            'name' => $request->name,
            'phone_number' => $phone_number,
            'amount' => $amount,
            'month' => date('m'),
            'week' => $request->amount,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'paid_at' => now(),
            'approved_at' => now(),
        ];

        $data['payment_proof'] = $request->file('payment_proof')->storeAs('payment-proof', Str::slug($request->name) . '-' . time() . '.' . $request->file('payment_proof')->getClientOriginalExtension());

        $createPay = Payment::create($data);
        if ($createPay) {
            SendStatus::dispatch('payment', $createPay->id, 'manual');
        } else {
            return abort(500);
        }

        for ($i = 1; $i <= $request->amount; $i++) {
            $latest = KasTracking::where('name', $request->name)->orderBy('id', 'DESC')->first();
            if (is_null($latest)) {
                $week = 1;
            } else if ($latest->week == 4) {
                $week = 1;
            } else {
                $week = $latest->week + 1;
            }

            if (is_null($latest)) {
                $month = date('m');
            } else if ($latest->month == 12 && $latest->week == 4) {
                $month = 1;
            } else if ($latest->week == 4) {
                $month = $latest->month + 1;
            } else {
                $month = $latest->month;
            }

            $createTrack = KasTracking::create([
                'name' => $request->name,
                'phone_number' => $phone_number,
                'amount' => 10000,
                'month' => $month,
                'week' => $week,
                'trx_code' => $trx_code,
            ]);
            if ($createTrack) {
                SendStatus::dispatch('tracking', $createTrack->id);
            } else {
                return abort(500);
            }
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan data kas ' . $request->amount . 'x atas nama ' . $request->name);
    }
}