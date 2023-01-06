<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (User::with('u_roles')->find(Auth::user()->id)->u_roles[0]->role == 'Anggota' || User::with('u_roles')->find(Auth::user()->id)->u_roles[0]->role == 'Pengunjung') {
            return redirect()->back();
        }
        return $next($request);
    }
}