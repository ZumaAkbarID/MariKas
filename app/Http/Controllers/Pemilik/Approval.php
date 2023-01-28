<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatus;
use App\Models\KasTracking;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Approval extends Controller
{
    public function index()
    {
        $data = [
            'preview' => Payment::where('status', 'preview')->get(),
            'approved' => Payment::where('status', 'approved')->get(),
            'rejected' => Payment::where('status', 'rejected')->get(),
        ];

        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Pemilik.approval', [
            'title' => 'Approval Pembayaran | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->limit(5)->get(),
            'data' => $data
        ]);
    }

    public function approve(Request $request)
    {
        $payment = Payment::where('trx_code', $request->code)->first();

        if ($payment->status !== 'preview') {
            return response()->json([
                'status' => 'error',
                'msg' => $request->code . ' tidak perlu di approve lagi'
            ]);
        } else {
            $updatePayment = $payment->update(['status' => 'approved', 'user_id' => Auth::user()->id, 'approved_at' => date('Y-m-d H:i:s')]);
            // $data = [
            //     'name' => $payment->name,
            //     'phone_number' => $payment->phone_number,
            //     'amount' => $payment->amount,
            //     'month' => $payment->month,
            //     'week' => $payment->week
            // ];

            send_dc_webhook(
                'kas-payment',
                [
                    [
                        'name' => 'Nama Si Sultan',
                        'value' => $payment->name,
                        'inline' => false,
                    ],
                    [
                        'name' => 'Nominal Berapa?',
                        'value' => "Rp. " . number_format($payment->amount, 0, ',', '.'),
                        'inline' => false,
                    ],
                    [
                        'name' => 'Status',
                        'value' => "LUNAS COY",
                        'inline' => false,
                    ],
                ],
                asset('storage') . "/" . $payment->payment_proof
            );

            for ($i = 1; $i <= $payment->week; $i++) {
                $latest = KasTracking::where('name', $payment->name)->orderBy('id', 'DESC')->first();
                if (is_null($latest)) {
                    $week = 1;
                } else if ($latest->week == 4) {
                    $week = 1;
                } else {
                    $week = $latest->week + 1;
                }

                if (is_null($latest)) {
                    $month = $payment->month;
                } else if ($latest->month == 12 && $latest->week == 4) {
                    $month = 1;
                } else if ($latest->week == 4) {
                    $month = $latest->month + 1;
                } else {
                    $month = $latest->month;
                }

                $createTrack = KasTracking::create([
                    'name' => $payment->name,
                    'phone_number' => $payment->phone_number,
                    'amount' => 10000,
                    'month' => $month,
                    'week' => $week,
                    'trx_code' => $payment->trx_code
                ]);
                if ($createTrack) {
                    SendStatus::dispatch('tracking', $createTrack->id);
                } else {
                    return abort(500);
                }
            }

            if ($updatePayment) {
                return response()->json([
                    'status' => 'success',
                    'msg' => $request->code . ' berhasil di approve & telah terdata'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Terjadi kesalahan ketika memperbarui & membuat tracking'
                ]);
            }
        }
    }

    public function reject(Request $request)
    {
        $payment = Payment::where('trx_code', $request->code)->first();

        if ($payment->status !== 'preview') {
            return response()->json([
                'status' => 'error',
                'msg' => $request->code . ' tidak berstatus preview'
            ]);
        } else {
            $updatePayment = $payment->update(['status' => 'rejected', 'user_id' => Auth::user()->id]);
            if ($updatePayment) {
                SendStatus::dispatch('payment', $payment->id, 'manual');
                return response()->json([
                    'status' => 'success',
                    'msg' => $request->code . ' berhasil di tolak'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Terjadi kesalahan ketika memperbarui'
                ]);
            }
        }
    }
}