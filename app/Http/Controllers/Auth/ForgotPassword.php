<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class ForgotPassword extends Controller
{
    public function index()
    {
        return view('Auth.forgot-password', [
            'title' => 'Reset Password | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig
        ]);
    }

    public function otp(Request $request)
    {
        try {
            if (is_numeric($request->auth)) {
                SendOtp::dispatch(null, $request->auth, 'Reset Password');
            } else {
                $user = User::where('username', $request->auth)->first();
                SendOtp::dispatch(null, $user->phone_number, 'Reset Password');
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'Kode berhasil terkirim. Masukan kode & buat password baru'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal mengirim OTP',
                'debug' => $e
            ]);
        }
    }

    public function process(Request $request)
    {
        // validasi otp & password
        if (strlen($request->otp) !== 6) {
            return response()->json([
                'status' => 'error',
                'msg' => 'OTP harus 6 digit angka',
                'debug' => ''
            ]);
        }

        if (strlen($request->password) < 6) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Password minimal 6 karakter',
                'debug' => ''
            ]);
        }

        // Check otp
        $otp = Otp::where('code', $request->otp)
            ->where('status', 'available')
            ->where('desc', 'Reset Password')
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => 'error',
                'msg' => 'OTP salah, periksa ulang WhatsApp Anda',
                'debug' => 'tidak ditemukan otp dengan code ' . $request->otp
            ]);
        }

        if (is_numeric($request->auth)) {
            $user = User::where('phone_number', $request->auth)->first();
        } else {
            $user = User::where('username', $request->auth)->first();
        }

        // update password user
        try {
            $update = User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
            return response()->json([
                'status' => 'success',
                'msg' => 'Password berhasil diperbarui',
                'debug' => $update
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Terjadi kesalahan ketika memperbarui password',
                'debug' => $e
            ]);
        }
    }
}