<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignAdminRequest;
use App\Http\Requests\UpdateDesignRequest;
use App\Models\desain;
use Illuminate\Http\Request;

class DesignAdminController extends Controller
{
    public function store(DesignAdminRequest $request)
    {
        // Simpan foto ke folder publik
        $fotoPath = $request->file('foto')->store('designs', 'public');

        // Simpan data ke database
        Desain::create([
            'konsep' => $request->input('konsep'),
            'lahan' => $request->input('lahan'),
            'harga' => $request->input(key: 'harga'),
            'foto' => $fotoPath, // Menyimpan path foto
        ]);

        return redirect()->route('design')->with('success', 'Desain berhasil ditambahkan!');
    }

    public function updatedesign(UpdateDesignRequest $request, $id)
    {
        $desain = Desain::findOrFail($id);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('designs', 'public');
            $desain->foto = $fotoPath;
        }

        $desain->konsep = $request->input('konsep');
        $desain->lahan = $request->input('lahan');

        // Bersihkan harga sebelum simpan
        $harga = preg_replace('/[^0-9]/', '', $request->input('harga'));
        $desain->harga = (int) $harga;

        $desain->save();

        return redirect()->route('design')->with('success', 'Desain berhasil diperbarui.');
    }




    public function deletedesign(desain $desain)
    {
        $desain->delete();
        return redirect()->route('design')->with('success', 'Design berhasil Dihapus.');
    }
}
