<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingpage()
    {
        // Mengambil jumlah user dari database
        $jumlahUser = User::count();

        // Mengambil jumlah kunjungan yang disimpan di session
        $jumlahKunjungan = session('kunjungan', 0);  // Jika session 'kunjungan' belum ada, set 0

        // Menambah kunjungan hanya di halaman home
        session(['kunjungan' => $jumlahKunjungan + 1]);

        // Mengirim data ke view
        return view('landing.home', compact('jumlahUser', 'jumlahKunjungan'));
    }

    public function about()
    {
        // Mengambil jumlah user dari database
        $jumlahUser = User::count();

        // Hanya menampilkan jumlah kunjungan tanpa menambahkannya
        $jumlahKunjungan = session('kunjungan', 0);  // Mengambil data kunjungan dari session yang sudah ada

        // Tidak ada penambahan kunjungan di halaman about
        return view('landing.about', compact('jumlahUser', 'jumlahKunjungan'));
    }

    public function Service()
    {
        return view('landing.service');
    }
    public function Contact()
    {
        return view('landing.contact');
    }
}
