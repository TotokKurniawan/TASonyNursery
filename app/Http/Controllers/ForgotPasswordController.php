<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function ForgotPassword()
    {
        return view('forgot');
    }
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        $user->password = $request->password;
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login.');
    }
}
