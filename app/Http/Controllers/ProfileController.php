<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        // Ambil user yang sedang login
        $user = auth()->user();

        // Update nama
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }

        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        // Jika ada foto profil yang diupload
        if ($request->hasFile('foto')) { // Perbaiki key dari 'profile_photo' ke 'foto'
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Upload foto baru
            $photoPath = $request->file('foto')->store('profile_users', 'public');
            $user->foto = $photoPath;
        }

        // Simpan perubahan
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
