<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\pengeluaran;
use App\Models\pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function Laporan()  // Nama metode dengan huruf kapital L
    {
        return view('admin.laporan');
    }

    public function cetakPengeluaran(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tglawal' => 'required|date',
            'tglakhir' => 'required|date',
        ]);

        // Ambil data pengeluaran berdasarkan tanggal
        $pengeluaran = Pengeluaran::whereBetween('tanggal', [$request->tglawal, $request->tglakhir])->get();

        // Mengirim data ke view untuk PDF
        $pdf = PDF::loadView('admin.pdf.cetakpengeluaran', compact('pengeluaran', 'request'));
        // return view('admin.pdf.cetakpengeluaran', compact('pengeluaran', 'request'));
        // Menghasilkan PDF dan mendownloadnya
        return $pdf->download('laporan_pengeluaran.pdf');
    }

    public function cetakPendapatan(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tglawal' => 'required|date',
            'tglakhir' => 'required|date',
        ]);

        // Ambil tanggal awal dan akhir dengan menambahkan waktu yang tepat
        $tglawal = $request->tglawal . ' 00:00:00';  // Tambahkan waktu 00:00:00 untuk tglawal
        $tglakhir = $request->tglakhir . ' 23:59:59';  // Tambahkan waktu 23:59:59 untuk tglakhir

        // Ambil data pesanan yang statusnya 'completed' dan sesuai dengan periode tanggal
        $pesanan = Pesanan::where('status', 'completed')
            ->whereBetween('created_at', [$tglawal, $tglakhir])
            ->with('pelanggan') // Mengambil data relasi dengan tabel pelanggan
            ->get();

        // Hitung total pendapatan dari budget
        $totalPendapatan = $pesanan->sum('budget');

        // Menghasilkan PDF
        $pdf = PDF::loadView('admin.pdf.cetakpendapatan', compact('pesanan', 'totalPendapatan', 'request'));

        // Download PDF
        return $pdf->download('laporan_pendapatan.pdf');
    }
}
