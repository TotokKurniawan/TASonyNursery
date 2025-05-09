<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganUserRequest;
use Illuminate\Http\Request;
use App\Models\pelanggan;
use App\Models\pesanan;

class PesananUserController extends Controller
{
    public function Pesanan2($id_pelanggan)
    {
        $pelanggan = pelanggan::findOrFail($id_pelanggan);
        return view('user.form.tamba-pesan2', compact('pelanggan'));
    }

    public function storepelangganuser(PelangganUserRequest $request)
    {
        // Tambahkan nilai default untuk id_user
        $data = $request->all();
        $data['id_user'] = auth()->user()->id; // Set nilai id_user menjadi 1

        // Simpan data pelanggan ke database
        $pelanggan = pelanggan::create($data);

        // Redirect ke halaman form pesanan dengan membawa ID pelanggan
        return redirect()->route('pesan2', ['id_pelanggan' => $pelanggan->id])
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'spesifikasi_lahan' => 'required|string|max:255',
            'request_bunga' => 'required|string',
            'tanggal_survei' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'keterangan_tambahan' => 'required|string',
            'foto_lokasi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_design' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Budget' => 'required|numeric|min:0',
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'pembayaran' => 'required|string|in:dp,belum lunas',
            'nominal_dp' => 'nullable|numeric|min:0',
        ]);

        // Upload file foto lokasi
        $fotoLokasiPath = $request->file('foto_lokasi')->store('uploads/foto_lokasi', 'public');

        // Upload file foto desain (jika ada)
        $fotoDesignPath = $request->hasFile('foto_design')
            ? $request->file('foto_design')->store('uploads/foto_design', 'public')
            : null;


        // Simpan data pesanan
        $pesanan = Pesanan::create([
            'spesifikasi_lahan' => $request->spesifikasi_lahan,
            'request_bunga' => $request->request_bunga,
            'foto_lokasi' => $fotoLokasiPath,
            'foto_desain' => $fotoDesignPath,
            'budget' => $request->Budget,
            'tanggal_survei' => $request->tanggal_survei,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'status' => 'pending',
            'id_pelanggan' => $request->id_pelanggan,
            'status_pembayaran' => $request->pembayaran,
            'nominal_dp' => $request->pembayaran === 'dp' ? $request->nominal_dp : 0,
            'bukti_dp' => 'NULL',
        ]);

        return redirect()->route('pesananUser')->with('success', 'Pesanan berhasil dibuat!');
    }


    public function tolak($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = pesanan::find($id);

        // Cek apakah pesanan ditemukan
        if ($pesanan) {
            // Update status pesanan menjadi 'tolak'
            $pesanan->status = 'canceled';
            $pesanan->save();

            // Redirect ke halaman yang sama atau halaman lain dengan pesan sukses
            return back()->with('success', 'Pesanan berhasil ditolak');
        }
    }
}
