<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Mendapatkan data pengguna dari Google
            $googleUser = Socialite::driver('google')->user();

            if (!$googleUser || !$googleUser->getEmail()) {
                return redirect()->route('login')->withErrors(['msg' => 'Data dari Google tidak valid.']);
            }

            // Periksa apakah pengguna sudah terdaftar
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // Login jika pengguna sudah ada
                Auth::login($existingUser);
            } else {
                // Buat pengguna baru jika belum terdaftar
                $newUser = User::create([
                    'nama' => $googleUser->getName() ?? 'Pengguna Tanpa Nama',
                    'email' => $googleUser->getEmail(),
                    'gambar' => $googleUser->getAvatar() ?? '',
                    'password' => Hash::make(Str::random(16)), // Password acak
                    'role' => 'user',
                ]);

                Auth::login($newUser);
            }

            return redirect()->route('index')->with('success', 'Login berhasil!');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['msg' => 'Terjadi kesalahan saat login: ' . $e->getMessage()]);
        }
    }
}
