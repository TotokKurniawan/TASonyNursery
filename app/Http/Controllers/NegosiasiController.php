<?php

namespace App\Http\Controllers;

use App\Models\Negosiasi;
use App\Models\pesanan;
use Illuminate\Http\Request;

class NegosiasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer',
            'id_pelanggan' => 'required|integer',
            'id_pesanan' => 'required|integer',
            'pesan' => 'required|string',
        ]);

        // Menyimpan data ke tabel negosiasi
        Negosiasi::create($request->only('id_user', 'id_pelanggan', 'id_pesanan', 'pesan'));

        // Memperbarui status pesanan menjadi "negosiasi"
        $pesanan = pesanan::find($request->id_pesanan);
        if ($pesanan) {
            $pesanan->status = 'negosiasi';
            $pesanan->save();
        }

        return back()->with('success', 'Pesan negosiasi berhasil dikirim dan status pesanan diperbarui menjadi negosiasi.');
    }
}
