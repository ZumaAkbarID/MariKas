<?php

namespace App\Http\Controllers\Tripay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Calc extends Controller
{
    public function price(Request $request)
    {
        return calc_price($request->code, $request->amount * 10000)['data'][0]['total_fee']['customer'];
    }
}