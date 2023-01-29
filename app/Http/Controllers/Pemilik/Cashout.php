<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\CashoutTracking;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cashout extends Controller
{
    public function index()
    {
        $data = [
            'data' =>  CashoutTracking::with('user')->get(),
            'totalAmount' => CashoutTracking::sum('amount')
        ];

        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Pemilik.cashout', [
            'title' => 'Pendataan Pengeluaran | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->orWhere('role', 'All')->limit(5)->get(),
            'data' => $data
        ]);
    }

    public function process(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'purpose' => $request->purpose,
            'datetime' => $request->datetime
        ];
        $data['cashout_proof'] = $request->file('cashout_proof')->storeAs('cashout_proof', date('Y-m-d-H-i-s') . '.' . $request->file('cashout_proof')->getClientOriginalExtension());


        if (CashoutTracking::create($data)) {
            send_dc_webhook(
                'kas-cashout',
                [
                    [
                        'name' => 'Jumlah',
                        'value' => "Rp. " . number_format($request->amount, 0, ',', '.'),
                        'inline' => false,
                    ],
                    [
                        'name' => 'Alasan / Tujuan',
                        'value' => $request->purpose,
                        'inline' => false,
                    ],
                    [
                        'name' => 'Status',
                        'value' => "Berhasil Terdata",
                        'inline' => false,
                    ],
                ],
                asset('storage') . '/' . $data['cashout_proof']
            );
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Data gagal disimpan');
        }
    }
}