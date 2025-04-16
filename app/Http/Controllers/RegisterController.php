<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register.
     */
    public function showRegisterForm()
    {
        return view(view: 'register'); // Pastikan file register.blade.php ada di folder resources/views/auth
    }

    /**
     * Proses data registrasi.
     */
    public function storeRegister(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Hashing password
            'role' => 'user', // Default role
        ]);

        // Redirect setelah sukses registrasi
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
