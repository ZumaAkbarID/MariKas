<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Controller
{
    public function index()
    {
        $user = ModelsUser::with('u_roles')->find(Auth::user()->id);
        return view('Profile.index', [
            'title' => 'User Profile | ' . $this->WConfig['app_name'],
            'config' => $this->WConfig,
            'user' => $user,
            'notification' => Notification::where('role', $user->u_roles[0]->role)->orWhere('role', 'All')->limit(5)->get(),
        ]);
    }

    public function process(Request $request)
    {
        if ($request->type == 'nonImg') {
            if (str_split($request->phone_number, 2)[0] !== '08') {
                return redirect()->back()->with('error', 'Nomor WhatsApp harus dimulai dari 08');
            }

            try {
                ModelsUser::where('id', Auth::user()->id)->update([
                    'username' => $request->username,
                    'phone_number' => $request->phone_number
                ]);

                return redirect()->back()->with('success', 'Data berhasil diperbarui');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memperbarui data');
            }
        } else if ($request->type == 'img') {
            if ($request->hasFile('profil_pic')) {

                $this->validate(
                    $request,
                    [
                        'profil_pic' => 'required|image|dimensions:ratio=1/1'
                    ],
                    [
                        'profil_pic.required' => 'Foto dibutuhkan',
                        'profil_pic.image' => 'Foto harus berupa gambar',
                        'profil_pic.dimensions' => 'Dimensi rasio foto harus 1:1'
                    ]
                );

                try {
                    if (!is_null(Auth::user()->profil_pic)) {
                        $oldImg = Auth::user()->profil_pic;
                        if (Storage::exists($oldImg)) {
                            $tempImgPath = 'profile-pic-temp/' . Str::slug(Auth::user()->name) . '.png';
                            $tempImg = Storage::move($oldImg, $tempImgPath);
                        }
                    }

                    $move = $request->file('profil_pic')->storeAs('profile-pic', Str::slug(Auth::user()->name) . '.png');

                    if (!$move) {
                        if (!is_null(Auth::user()->profil_pic) && Storage::exists($tempImgPath)) {
                            Storage::move($tempImgPath, 'profile-pic/' . Str::slug(Auth::user()->name) . '.png');
                        }
                        return redirect()->back()->with('error', "Gagal memindah Foto");
                    } else {
                        if (Storage::exists($tempImgPath)) {
                            Storage::delete($tempImgPath);
                        }
                    }
                    ModelsUser::where('id', Auth::user()->id)->update(['profil_pic' => $move]);
                    return redirect()->back()->with('success', "Berhasil memperbarui Foto.");
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', "Gagal memperbarui Foto. $e");
                }
            }
        } else {
            return abort(404);
        }
    }
}
