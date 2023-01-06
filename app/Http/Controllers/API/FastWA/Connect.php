<?php

namespace App\Http\Controllers\API\FastWA;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Connect extends Controller
{
    public function index()
    {
        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('API.FastWA.connect', [
            'title' => 'Sambungkan WhatsApp',
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->limit(5)->get(),
            'data' => get_qr_code()
        ]);
    }
}