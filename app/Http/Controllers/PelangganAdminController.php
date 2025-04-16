<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelanggannAdminRequest;
use App\Models\pelanggan;

class PelangganAdminController extends Controller
{
    public function deletepelanggan(pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil Dihapus.');
    }
}
