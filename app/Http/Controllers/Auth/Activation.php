<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Activation extends Controller
{
    public function form()
    {
        return view('Auth.activation', [
            'title' => 'Verifikasi | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig
        ]);
    }

    public function process(Request $request)
    {
        $this->validate(
            $request,
            [
                'otp' => 'required|numeric'
            ],
            [
                'otp.required' => 'Kode OTP wajib diisi',
                'otp.numeric' => 'Kode OTP hanya mengandung angka!',
            ]
        );

        if (str_split(Auth::user()->phone_number, 2)[0] == '08') {
            $n = explode("08", Auth::user()->phone_number);
            $phone_number = '628' . $n[1];
        }

        $checkOtp = Otp::where('phone_number', $phone_number)->where('code', $request->otp)->where('status', 'available')->first();

        if ($checkOtp) {
            if (User::where('id', Auth::user()->id)->update(['phone_verified_at' => now(), 'status' => 'Aktif'])) {
                Otp::where('id', $checkOtp->id)->update(['status' => 'used']);
                return redirect()->to('/')->with('success', 'Nomor WhatsApp berhasil diverifikasi');
            } else {
                Otp::where('id', $checkOtp->id)->update(['status' => 'expire']);
                SendOtp::dispatch(Auth::user()->id, Auth::user()->phone_number);
                return redirect()->back()->with('error', 'Gagal aktifasi akun. Kode baru telah dikirim');
            }
        } else {
            return redirect()->back()->with('error', 'Kode tidak valid');
        }
    }

    public function send_otp()
    {
        SendOtp::dispatch(Auth::user()->id, Auth::user()->phone_number);
        return redirect()->back()->with('success', 'Kode OTP baru telah dikirim');
    }
}
