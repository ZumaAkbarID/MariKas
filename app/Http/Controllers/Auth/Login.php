<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function form()
    {
        return view('Auth.login', [
            'title' => 'Daftar | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig
        ]);
    }

    public function process(Request $request)
    {
        $this->validate(
            $request,
            [
                'auth' => 'required',
                'password' => 'required'
            ],
            [
                'auth.required' => 'Username atau Nomor WhatsApp wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        if (is_numeric($request->auth)) {
            if (Auth::attempt(['phone_number' => $request->auth, 'password' => $request->password], true)) {
                if (is_null(Auth::user()->phone_number)) {
                    SendOtp::dispatch(Auth::user()->id, Auth::user()->phone_number);
                    return redirect()->intended(route('Auth_activation'));
                } else {
                    return redirect()->intended('/dashboard');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Akun tidak ditemukan');
            }
        } else {
            if (Auth::attempt(['username' => $request->auth, 'password' => $request->password], true)) {
                if (is_null(Auth::user()->phone_number)) {
                    SendOtp::dispatch(Auth::user()->id, Auth::user()->phone_number);
                    return redirect()->intended(route('Auth_activation'));
                } else {
                    return redirect()->intended('/dashboard');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Akun tidak ditemukan');
            }
        }
    }
}