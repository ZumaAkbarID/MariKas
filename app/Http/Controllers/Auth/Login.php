<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use App\Models\LoginLogger;
use App\Models\WConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function form()
    {
        return view('Auth.login', [
            'title' => 'Masuk | ' . $this->WConfig['app_name'],
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
                    if (WConfig::where('key', 'app_env')->first()->value == 'production') {
                        LoginLogger::create([
                            'user_id'    => Auth::user()->id,
                            'ip_address' => $request->getClientIp(),
                            'user_agent' => $request->userAgent(),
                        ]);
                        send_dc_webhook('custom', [
                            [
                                'name' => 'User',
                                'value' => Auth::user()->name,
                                'inline' => false
                            ],
                            [
                                'name' => 'IP',
                                'value' => $request->getClientIp(),
                                'inline' => false
                            ],
                            [
                                'name' => 'User Agent',
                                'value' => $request->userAgent(),
                                'inline' => false
                            ],
                        ], null, 'https://discordapp.com/api/webhooks/1069350551034286120/5z9BKBMhNLsgZDZMUeXTCiFt1Sx0i2jtsCnhqWjUasPOFnt5NIvnQDxZtFyH8o6C73sn');
                    }

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
                    if (WConfig::where('key', 'app_env')->first()->value == 'production') {
                        LoginLogger::create([
                            'user_id'    => Auth::user()->id,
                            'ip_address' => $request->getClientIp(),
                            'user_agent' => $request->userAgent(),
                        ]);
                        send_dc_webhook('custom', [
                            [
                                'name' => 'User',
                                'value' => Auth::user()->name,
                                'inline' => false
                            ],
                            [
                                'name' => 'IP',
                                'value' => $request->getClientIp(),
                                'inline' => false
                            ],
                            [
                                'name' => 'User Agent',
                                'value' => $request->userAgent(),
                                'inline' => false
                            ],
                        ], null, 'https://discordapp.com/api/webhooks/1069350551034286120/5z9BKBMhNLsgZDZMUeXTCiFt1Sx0i2jtsCnhqWjUasPOFnt5NIvnQDxZtFyH8o6C73sn');
                    }

                    return redirect()->intended('/dashboard');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Akun tidak ditemukan');
            }
        }
    }
}