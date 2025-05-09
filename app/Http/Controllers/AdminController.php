<?php

namespace App\Http\Controllers;

use App\Models\desain;
use App\Models\pengeluaran;
use App\Models\pelanggan;
use App\Models\pesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Dashboard()
    {
        // Menghitung pendapatan per bulan untuk tahun ini
        $monthlyIncome = [];
        for ($month = 1; $month <= 12; $month++) {
            $total = pesanan::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->where('status', 'completed')
                ->sum('budget');

            // Masukkan total pendapatan per bulan ke dalam array
            $monthlyIncome[] = $total;
        }

        // Menghitung total pengeluaran per bulan untuk tahun ini
        $monthlyExpenses = [];
        for ($month = 1; $month <= 12; $month++) {
            $total = pengeluaran::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('jumlah');

            // Masukkan total pengeluaran per bulan ke dalam array
            $monthlyExpenses[] = $total;
        }

        // Menghitung total pendapatan (budget) bulan ini dengan status 'completed'
        $totalIncome = pesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'completed')
            ->sum('budget');

        // Menghitung total pengeluaran bulan ini
        $totalExpenses = pengeluaran::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('jumlah');

        // Menghitung total pelanggan yang terdaftar pada tahun ini
        $totalCustomersPerYear = pelanggan::whereYear('created_at', Carbon::now()->year)
            ->count();

        // Menghitung total pendapatan per tahun
        $totalYearIncome = pesanan::whereYear('created_at', Carbon::now()->year)
            ->where('status', 'completed')  // Menambahkan filter status 'completed'
            ->sum('budget');

        // Mengambil data pelanggan yang mencakup latitude dan longitude
        // $pelangganList = pelanggan::all();
        $pelangganList = pelanggan::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // Mengirimkan data ke view
        return view('admin.dashboard', compact(
            'monthlyIncome',
            'totalIncome',
            'totalExpenses',
            'totalCustomersPerYear',
            'totalYearIncome',
            'monthlyExpenses',
            'pelangganList' // Menambahkan pelangganList untuk peta
        ));
    }


    public function Pelanggan()
    {
        $pelanggans = pelanggan::paginate(10);
        return view('admin.pelanggan', compact('pelanggans'));
    }
    public function Design()
    {
        $desains = desain::paginate(10); // Hanya perlu satu query untuk paginasi
        return view('admin.design', compact('desains'));
    }
    public function Pengeluaran()
    {
        $pengeluarans = Pengeluaran::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pengeluaran', compact('pengeluarans'));
    }

    public function profile()
    {
        // Ambil data pengguna berdasarkan ID (ID=1, atau ganti sesuai kebutuhan)
        $user = User::find(auth()->user()->id);

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return back()->with('error', 'User not found');
        }

        // Kirim data pengguna ke tampilan profile
        return view('admin.profile', compact('user'));
    }
    public function TambahPengeluaran()
    {
        return view('admin.form.tambahpengeluaran');
    }
    public function TambahDesain()
    {
        return view('admin.form.tambahdesign');
    }
    public function Pesan()
    {
        $customers = User::all();
        return view('admin.pesan', compact('customers'));
    }
}
