<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function showPembayaranBank() // Jika membutuhkan parameter $id
    {
        // Anda dapat menambahkan logika untuk mengambil data pesanan berdasarkan ID
        // $pesanan = pesanan::findOrFail($id);

        // Mengirimkan view dengan data pesanan jika perlu
        return view('user.pembayaranbank'); // Pastikan 'pesanan' sudah didefinisikan
    }
}
