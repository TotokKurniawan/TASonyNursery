<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    // public function login(Request $request)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Ambil user berdasarkan email
    //     $user = User::where('email', trim($request->email))->first();

    //     // Debugging untuk memastikan data sesuai
    //     if (!$user) {
    //         return back()->withErrors(['email' => 'Email tidak ditemukan di database.']);
    //     }

    //     // Periksa jika user ditemukan dan password cocok
    //     if (Hash::check($request->password, $user->password)) {
    //         // Login user jika password cocok
    //         Auth::login($user);

    //         // Redirect berdasarkan role
    //         if ($user->role == 'admin') {
    //             return redirect()->route('dashboard'); // Halaman dashboard admin
    //         } else {
    //             return redirect()->route('homeuser'); // Halaman untuk pengguna biasa
    //         }
    //     } else {
    //         // Jika password salah
    //
    //     }

    //     // // Jika login gagal, beri pesan error lebih detail
    //     //
    // }




    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput();
        }

        // Pastikan password dalam database telah di-hash
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Langsung login jika password cocok

            // Regenerasi session
            $request->session()->regenerate();

            // Periksa role dan redirect sesuai
            if ($user->role == 'admin') {
                return redirect()->route('dashboard')->with('success', 'Berhasil Login!');
            } else {
                return redirect()->route('homeuser');
            }
        } else {
            return back()->withErrors(['password' => 'Email atau Password salah.']);
        }
    }


    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout(); // Menghapus autentikasi pengguna yang sedang login
        $request->session()->invalidate(); // Menghapus seluruh data session
        $request->session()->regenerateToken(); // Menghindari serangan CSRF pada session baru

        return redirect()->route(route: 'home'); // Mengarahkan kembali ke halaman login
    }
}
