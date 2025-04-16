<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengeluaranAdminRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use App\Models\Pengeluaran;

class PengeluaranAdminController extends Controller
{
    public function store(PengeluaranAdminRequest $request)
    {
        Pengeluaran::create($request->validated());
        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }
    public function updatepengeluaran(UpdatePengeluaranRequest $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->validated());
        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function deletepengeluaran(pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran berhasil Dihapus.');
    }
}
