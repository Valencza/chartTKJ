<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

        // Proses upload foto profil jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Buat nama unik
            $filePath = 'img/profil/' . $fileName; // Path untuk storage

            // Hapus foto lama jika ada dan bukan URL dari Google
            if ($user->gambar && !filter_var($user->gambar, FILTER_VALIDATE_URL)) {
                $oldImagePath = str_replace('storage/', '', $user->gambar); // Hapus "storage/" agar cocok dengan path storage
                Storage::disk('public')->delete($oldImagePath);
            }

            // Simpan gambar baru ke storage (storage/app/public/img/profil)
            $file->storeAs('public/' . $filePath);

            // Simpan path gambar ke database (dengan prefix 'storage/')
            $user->gambar = 'storage/' . $filePath;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
