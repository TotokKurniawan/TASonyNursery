<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganUserRequest;
use App\Models\desain;
use Illuminate\Http\Request;
use App\Models\pelanggan;
use App\Models\pesanan;

class PesananUserController2 extends Controller
{
    public function Pesanan4($id_pelanggan)
    {
        $designs = desain::all();
        $pelanggan = pelanggan::findOrFail($id_pelanggan);

        return view('user.form.tambapesan2', compact('designs', 'pelanggan'));
    }
    public function storeuserbydesign(PelangganUserRequest $request)
    {
        // Tambahkan nilai default untuk id_user
        $data = $request->all();
        $data['id_user'] = auth()->user()->id; // Set nilai id_user menjadi 1

        // Simpan data pelanggan ke database
        $pelanggan = pelanggan::create($data);

        // Redirect atau respons sesuai kebutuhan
        return redirect()->route('pesan4', ['id_pelanggan' => $pelanggan->id])
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function storePesanan2(Request $request, $id_pelanggan)
    {
        // Validasi input form
        $validated = $request->validate([
            'design_id' => 'required|exists:desains,id',
            'spesifikasi_lahan' => 'required|string|max:255',
            'tanggal_pengerjaan' => 'required|date',
            'waktu_pengerjaan' => 'required|string|max:255',
            'status_pembayaran' => 'required|in:dp,belum lunas',
            'nominal_dp' => 'nullable|numeric|min:0', // Validasi untuk nominal DP (jika ada)
            'request_bunga' => 'required|string|max:1000',
            'keterangan_tambahan' => 'nullable|string|max:1000',
            'foto_lokasi' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Budget' => 'required|string',
        ]);

        // Membersihkan input budget agar hanya angka
        $budget = preg_replace('/\D/', '', $request->Budget);

        // Simpan foto lokasi
        $fotoLokasiPath = $request->file('foto_lokasi')->store('uploads/foto_lokasi', 'public');

        // Simpan data pesanan
        $pesanan = new Pesanan();
        $pesanan->id_desain = $request->design_id;
        $pesanan->id_pelanggan = $id_pelanggan;
        $pesanan->spesifikasi_lahan = $request->spesifikasi_lahan;
        $pesanan->tanggal_pengerjaan = $request->tanggal_pengerjaan;
        $pesanan->waktu_pengerjaan = $request->waktu_pengerjaan;
        $pesanan->status_pembayaran = $request->status_pembayaran;
        $pesanan->nominal_dp = $request->status_pembayaran === 'dp' ? $request->nominal_dp : 0;
        $pesanan->request_bunga = $request->request_bunga;
        $pesanan->keterangan_tambahan = $request->keterangan_tambahan;
        $pesanan->foto_lokasi = $fotoLokasiPath;
        $pesanan->budget = $budget;
        $pesanan->status = 'pending';
        $pesanan->save();

        return redirect()->route('pesananUser', ['id_pelanggan' => $id_pelanggan])
            ->with('success', 'Pesanan berhasil ditambahkan!');
    }
}
