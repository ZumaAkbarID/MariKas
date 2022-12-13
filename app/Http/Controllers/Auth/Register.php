<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use App\Models\Otp;
use App\Models\UDetail;
use App\Models\URole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function form()
    {
        return view('Auth.register', [
            'title' => 'Daftar | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig
        ]);
    }

    public function process(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'username' => 'required|unique:users,username',
                // 'email' => 'required|email:rfc,dns|unique:users,email',
                'phone_number' => 'required|numeric|unique:users,phone_number',
                'address' => 'required|min:8',
                'password' => 'required|min:8|confirmed'
            ],
            [
                'name.required' => 'Nama Lengkap wajib diisi',
                'username.required' => 'Username wajib diisi',
                // 'email.required' => 'Email wajib diisi',
                'phone_number.required' => 'Nomor WhatsApp wajib diisi',
                'address.required' => 'Alamat wajib diisi',
                'password.required' => 'Password wajib diisi',
                'username.unique' => 'Username telah terdaftar',
                // 'email.unique' => 'Email telah terdaftar',
                'phone_number.unique' => 'Nomor WhatsApp telah terdaftar',
                // 'email.email' => 'Email tidak valid',
                'phone_number.numeric' => 'Nomor WhatsApp tidak boleh mengandung selain angka',
                'address.min' => 'Alamat minimal 8 huruf',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sama'
            ]
        );

        // if (str_split($request->phone_number, 2)[0] !== '08') {
        //     return redirect()->back()->withInput()->with('error', 'Nomor WhatsApp hanya boleh berawalan 62 atau 08');
        // }
        // if (str_split($request->phone_number, 2)[0] !== '62') {
        //     return redirect()->back()->withInput()->with('error', 'Nomor WhatsApp hanya boleh berawalan 62 atau 08');
        // }

        $user = User::create(
            [
                'name' => $request->name,
                'username' => $request->username,
                // 'email' => $request->email,
                'phone_number' => $request->phone_number,
                'status' => 'Aktivasi',
                'password' => Hash::make($request->password),
            ]
        );

        if ($user) {
            $UDetail = UDetail::create(
                [
                    'user_id' => $user->id,
                    'address' => $request->address,
                ]
            );
            if ($UDetail) {
                if (URole::create(
                    [
                        'user_id' => $user->id,
                        'role_id' => 4
                    ]
                )) {
                    $request->session()->regenerate();

                    SendOtp::dispatch($user->id, $request->phone_number);

                    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                        return redirect()->intended(route('Auth_activation'));
                    } else {
                        return redirect()->to(Route('Auth_login'))->with('error', 'Gagal auto login, silahken login manual');
                    }
                } else {
                    return redirect()->back()->withInput()->with('error', 'Gagal mendata akun, hubungi developer. Code: 3');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mendata akun, hubungi developer. Code: 2');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mendata akun, hubungi developer. Code: 1');
        }
    }
}
