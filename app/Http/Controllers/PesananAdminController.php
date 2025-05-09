<?php

namespace App\Http\Controllers;

use App\Models\negosiasi;
use App\Models\pesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananAdminController extends Controller
{
    public function Pesanan()
    {
        $pesanans = Pesanan::with(['pelanggan', 'desain', 'negosiasi'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.pesanan', compact('pesanans'));
    }

    public function tolakadmin(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);

        if ($pesanan) {
            $pesanan->status = 'canceled';
            $pesanan->keterangan_tolak = $request->keterangan_tolak; // kolom ini yang disimpan
            $pesanan->save();

            return back()->with('success', 'Pesanan berhasil ditolak dengan alasan.');
        }

        return back()->with('error', 'Pesanan tidak ditemukan.');
    }

    public function terimaadmin($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = pesanan::find($id);

        // Cek apakah pesanan ditemukan
        if ($pesanan) {
            // Update status pesanan menjadi 'in progress'
            $pesanan->status = 'in progress (bayar dp)';
            $pesanan->save();

            // Redirect dengan pesan sukses
            return back()->with('success', 'Pesanan berhasil diterima');
        }

        return back()->with('error', 'Pesanan tidak ditemukan');
    }
    public function lanjutadmin($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = pesanan::find($id);

        // Cek apakah pesanan ditemukan
        if ($pesanan) {
            // Update status pesanan menjadi 'in progress'
            $pesanan->status = 'in progress (pembuatan taman)';
            $pesanan->save();

            // Redirect dengan pesan sukses
            return back()->with('success', 'Pesanan berhasil diterima');
        }

        return back()->with('error', 'Pesanan tidak ditemukan');
    }
    public function terimalunas($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = pesanan::find($id);

        // Cek apakah pesanan ditemukan
        if ($pesanan) {
            // Update status pesanan menjadi 'in progress'
            $pesanan->status = 'in progress (survei)';
            $pesanan->save();

            // Redirect dengan pesan sukses
            return back()->with('success', 'Pesanan berhasil diterima');
        }

        return back()->with('error', 'Pesanan tidak ditemukan');
    }
    public function selesaiadmin($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = pesanan::find($id);

        // Cek apakah pesanan ditemukan
        if ($pesanan) {
            // Update status pesanan menjadi 'completed'
            $pesanan->status = 'completed';
            $pesanan->status_pembayaran = 'lunas';
            $pesanan->save();

            // Redirect dengan pesan sukses
            return back()->with('success', 'Pesanan berhasil diselesaikan');
        }

        return back()->with('error', 'Pesanan tidak ditemukan');
    }
    public function updateMetodePembayaran(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'metode_pembayaran' => 'required|string|in:cash,bank_transfer', // Hanya cash atau bank_transfer
        ]);

        // Cari pesanan berdasarkan ID
        $pesanan = pesanan::findOrFail($id);

        // Update metode pembayaran
        $pesanan->metode_pembayaran = $request->metode_pembayaran;
        $pesanan->save();

        // Redirect kembali ke halaman pesanan dengan pesan sukses
        return redirect()->back();
    }
    public function cetakPesanan2($id)
    {
        $pesanan = Pesanan::with(['pelanggan', 'desain'])->findOrFail($id);

        $pesanan->foto_lokasi = $pesanan->foto_lokasi ? public_path('storage/' . $pesanan->foto_lokasi) : null;
        $pesanan->foto_desain = $pesanan->foto_desain ? public_path('storage/' . $pesanan->foto_desain) : null;

        $pdf = PDF::loadView('admin.pdf.cetakpesanan', compact('pesanan'));

        return $pdf->download('cetakpesanan.pdf');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'budget' => 'required',
            'tanggal_survei' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status_pembayaran' => 'required|in:belum,dp,lunas,dp lunas',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        // Hapus Rp, titik, dan spasi
        $cleanBudget = preg_replace('/[^\d]/', '', $request->budget);

        $pesanan->update([
            'budget' => (int) $cleanBudget,
            'tanggal_survei' => $request->tanggal_survei,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil diperbarui.');
    }
}
