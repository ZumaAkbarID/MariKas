<?php

namespace App\Http\Controllers;

use App\Jobs\SendStatus;
use App\Models\KasTracking;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\PaymentTripay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PayKas extends Controller
{
    public function form()
    {
        return view('Pay.form', [
            'title' => 'Pembayaran Kas | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'tripay_channel' => get_channel(),
            'payment' => $this->payment,
            'user' => User::all()
        ]);
    }

    public function get_phone(Request $request)
    {
        # code...
    }

    public function process(Request $request)
    {
        $namaFound = 0;
        for ($i = 0; $i < count(User::all()); $i++) {
            if (User::get()[$i]->name == $request->name) {
                $namaFound = 1;
            }
        }

        if ($namaFound == 0) {
            return redirect()->back()->with('error', 'Apakah kamu (' . $request->name . ') anggota Marimas? ');
        }

        $phone_number = '';
        if (str_split($request->phone_number, 2)[0] == '08') {
            $n = explode("08", $request->phone_number);
            $phone_number = '628' . $n[1];
        } else {
            $phone_number = $request->phone_number;
        }

        $amount = $request->amount * 10000;

        if ($request->method == 'Manual') {
            $data = [
                'trx_code' => 'MARIKAS-' . uniqid(),
                'name' => $request->name,
                'phone_number' => $phone_number,
                'month' => date('m'),
                'week' => $request->amount,
                'amount' => $amount,
                'status' => 'preview',
                'paid_at' => now(),
            ];

            $data['payment_proof'] = $request->file('payment_proof')->storeAs('payment-proof', Str::slug($request->name) . '-' . time() . '.' . $request->file('payment_proof')->getClientOriginalExtension());
            $createPay = Payment::create($data);
            if ($createPay) {
                SendStatus::dispatch('payment', $createPay->id, 'manual');
                send_msg('6281367647589', "{$request->name} bayar kas via manual coy, cek gih");
                Notification::create([
                    'type' => 'info',
                    'message' => $request->name . " membayar kas secara manual dan perlu direview",
                    'role' => 'Pemilik',
                ]);
                Notification::create([
                    'type' => 'info',
                    'message' => $request->name . " membayar kas secara manual dan perlu direview",
                    'role' => 'Developer',
                ]);
            } else {
                Notification::create([
                    'type' => 'warning',
                    'message' => "Terjadi kesalahan ketika " . $request->name . " membayar kas manual",
                    'role' => 'Pemilik',
                ]);
                Notification::create([
                    'type' => 'warning',
                    'message' => "Terjadi kesalahan ketika " . $request->name . " membayar kas manual",
                    'role' => 'Developer',
                ]);
                return abort(500);
            }

            return redirect()->back()->with('success', 'Pembayaran akan direview segera. Kas ' . $request->amount . 'x atas nama ' . $request->name);
        } else if ($request->method == 'Otomatis') {

            return redirect()->back()->with('error', 'Pembayaran otomatis sedang dalam tahap pengembangan. MALES EY BLM DISEMANGATIN AYANG XIXI');

            $privateKey   = 'UQLSQ-i4jxn-mDaXc-1Jgi1-nX5Rf';
            $merchantCode = 'T9501';
            $merchantRef  = 'MARIKAS-' . uniqid();

            $signature = hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey);

            $phone_number = '';
            if (str_split($request->phone_number, 2)[0] == '08') {
                $n = explode("08", $request->phone_number);
                $phone_number = '628' . $n[1];
            }

            $data = [
                'method' => $request->via,
                'merchant_ref' => $merchantRef,
                'amount' => $amount,
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_phone' => $phone_number,
                'order_items' => [
                    [
                        'sku' => 'KAS-1-MG',
                        'name' => 'KAS Mingguan',
                        'price' => 10000,
                        'quantity' => $request->amount
                    ]
                ],
                'signature' => $signature
            ];

            $create = request_trx($data);
            if ($create['success'] == true) {
                $query = [
                    'method' => $request->via,
                    'merchant_ref' => $merchantRef,
                    'amount' => $amount,
                    'customer_name' => $request->name,
                    'customer_email' => $request->email,
                    'customer_phone' => $phone_number,
                    'order_items' => json_encode([
                        [
                            'sku' => 'KAS-1-MG',
                            'name' => 'KAS Mingguan',
                            'price' => 10000,
                            'quantity' => $request->amount
                        ]
                    ]),
                    'signature' => $signature,
                    'checkout_url' => $create['data']['checkout_url'],
                    'status' => $create['data']['status'],
                    'month' => $request->month,
                    'week' => $request->amount,
                    'expired_time' => $create['data']['expired_time'],
                ];
                $paymentTripay = PaymentTripay::create($query);
                if ($paymentTripay) {
                    SendStatus::dispatch('payment', $paymentTripay->id, 'otomatis');
                    Notification::create([
                        'type' => 'info',
                        'message' => $request->name . " mencoba membayar secara otomatis",
                        'role' => 'Pemilik',
                    ]);
                } else {
                    Notification::create([
                        'type' => 'warning',
                        'message' => "Terjadi kesalahan ketika " . $request->name . " membayar kas otomatis",
                        'role' => 'Pemilik',
                    ]);
                }

                return redirect()->to($create['data']['checkout_url']);
            }
        }
    }
}
