<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\WConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Config extends Controller
{
    public function index()
    {
        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Config.website', [
            'title' => 'Config Web | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->limit(5)->get(),
            'data' => WConfig::all()
        ]);
    }

    public function update(Request $request)
    {
        $wconf      = WConfig::all();

        if ($request->type == 'nonImg') {

            for ($i = 0; $i < count($wconf); $i++) {
                if (isset($request->{$wconf[$i]->key}) && !is_null($request->{$wconf[$i]->key})) {
                    try {
                        WConfig::where('key', $wconf[$i]->key)->update(['value' => $request->{$wconf[$i]->key}]);
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', "Gagal memperbarui config pada index ke-" . $i . " key : {$wconf[$i]->key}");
                    }
                }
            }
            return redirect()->back()->with('success', "Berhasil memperbarui data config");
        } else if ($request->type == 'img') {
            if ($request->hasFile('qris_url')) {
                try {
                    $move = $request->file('qris_url')->storeAs('payment', 'MariKas-QRIS-' . time() . '.png');
                    if (!$move) {
                        return redirect()->back()->with('error', "Gagal memindah gambar QRIS");
                    }
                    WConfig::where('key', 'qris_url')->update(['value' => $move]);
                } catch (\Throwable $th) {
                    if (Storage::exists($move)) {
                        Storage::delete($move);
                    }
                    return redirect()->back()->with('error', "Gagal memperbarui gambar QRIS");
                }
            }
            return redirect()->back()->with('success', "Berhasil memperbarui gambar");
        } else {
            return abort(404);
        }
    }
}
