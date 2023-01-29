<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Settings extends Controller
{
    public function index()
    {
        $user = User::with('u_roles')->find(Auth::user()->id);
        return view('Profile.settings', [
            'title' => 'Pengaturan Akun | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->orWhere('role', 'All')->limit(5)->get(),
        ]);
    }

    public function process(Request $request)
    {
        if ($request->type == 'notif') {
            try {
                User::where('id', Auth::user()->id)->update([
                    'broadcast' => $request->broadcast,
                    'notif_wa' => $request->notif_wa,
                ]);
                return redirect()->back()->with('success', 'Berhasil memperbarui data notifikasi');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memperbarui data notifikasi');
            }
        } else if ($request->type == 'change-password') {
            if (!Hash::check($request->oldPassword, Auth::user()->password)) {
                return redirect()->back()->with('error', 'Password lama salah');
            } else if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->with('error', 'Password baru & password konfirmasi tidak sama');
            } else if (strlen($request->password) < 6) {
                return redirect()->back()->with('error', 'Password minimal 6 karakter');
            }

            try {
                User::where('id', Auth::user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);
                return redirect()->back()->with('success', "Password berhasil diperbarui");
            } catch (\Exception $e) {
                return redirect()->back()->with('success', "Password gagal diperbarui. $e");
            }
        } else {
            return abort(404);
        }
    }
}