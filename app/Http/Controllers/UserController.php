<?php

namespace App\Http\Controllers;

use App\Models\desain;
use App\Models\pelanggan;
use App\Models\pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Homepage()
    {
        $jumlahUser = User::count();
        $jumlahKunjungan = session('kunjungan', 0);  // Jika session 'kunjungan' belum ada, set 0

        session(['kunjungan' => $jumlahKunjungan]);
        return view('user.home', compact('jumlahUser', 'jumlahKunjungan'));
    }
    public function AboutUser()
    {
        $jumlahUser = User::count();
        $jumlahKunjungan = session('kunjungan', 0);  // Jika session 'kunjungan' belum ada, set 0

        session(['kunjungan' => $jumlahKunjungan]);
        return view('user.about', compact('jumlahUser', 'jumlahKunjungan'));
    }
    public function ServiceUser()
    {
        return view('user.service');
    }
    public function PesananUser()
    {
        // Set id_user ke 1
        $id_user = auth()->user()->id;

        // Ambil data pesanan terbaru berdasarkan id_user di tabel users, diurutkan berdasarkan created_at
        $pesanans = Pesanan::with(['pelanggan', 'desain'])
            ->whereHas('pelanggan', function ($query) use ($id_user) {
                $query->where('id_user', $id_user);
            })
            ->orderBy('created_at', 'desc') // Sorting pesanan berdasarkan created_at terbaru
            ->get();

        // Tampilkan data ke view
        return view('user.pesanansaya', compact('pesanans'));
    }
    public function ContactUser()
    {
        return view('user.contact');
    }
    public function profileUser()
    {
        // Ambil data pengguna berdasarkan ID (ID=1, atau ganti sesuai kebutuhan)
        $user = User::find(auth()->user()->id);
        if (!$user) {
            return back()->with('error', 'User not found');
        }

        // Kirim data pengguna ke tampilan profile
        return view('user.profile', compact('user'));
    }
    public function TambahPesan()
    {
        $pelanggans = pelanggan::where('id_user', auth()->user()->id)->get();
        return view('user.form.tambah-pesan', compact('pelanggans'));
    }
    public function TambahPesan3()
    {
        $pelanggans = pelanggan::where('id_user', auth()->user()->id)->get();
        return view('user.form.tambahpesan', compact('pelanggans'));
    }
}
