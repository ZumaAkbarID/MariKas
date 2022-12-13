<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        return Auth::user()->getRole;
        return view('Dashboard.dashboard', [
            'title' => 'HELO',
            'config' => $this->WConfig
        ]);
    }
}
