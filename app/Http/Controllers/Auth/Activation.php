<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Activation extends Controller
{
    public function form()
    {
        return view('Auth.activation', [
            'title' => 'Verifikasi | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig
        ]);
    }
}
