<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;

class ProfileController extends Controller
{
    public function formEdit()
    {
        $user = Auth::user();
        return view('home.pengaturan-akun', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telpon' => 'nullable|string|regex:/^\d{4}-\d{4}-\d{4}$/',
            'password' => 'nullable|string|min:6',
            'newPassword' => 'nullable|string|min:6|different:password',
            'verifikasiPassword' => 'nullable|string|same:newPassword',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update nama dan email
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telpon = $request->no_telpon;

        // Update password jika diisi
        if ($request->password && $request->newPassword) {
            if (Hash::check($request->password, $user->password)) {
                $user->password = Hash::make($request->newPassword);
            } else {
                return back()->with('error', 'Password lama salah!');
            }
        }

        // Penanganan gambar pakai move()
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika bukan dari Google (bukan URL eksternal)
        if ($user->gambar && !filter_var($user->gambar, FILTER_VALIDATE_URL)) {
            $oldImagePath = public_path($user->gambar);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $image = $request->file('gambar');
        $filename = Str::slug($user->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/profil'), $filename);
        $user->gambar = 'img/profil/' . $filename;
    }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
