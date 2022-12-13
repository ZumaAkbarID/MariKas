<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Controller
{
    public function process(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        Session::flush();
        return redirect()->to(route('Auth_login'))->with('success', 'Logout berhasil, semoga harimu menyenangkan :D');
    }
}
