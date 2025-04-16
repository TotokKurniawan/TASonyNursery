<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi penamaan
    protected $table = 'pengeluarans'; // Nama tabel dalam database

    // Tentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal',
        'jumlah',
        'keterangan'
    ];

    // Tentukan kolom-kolom yang tidak dapat diisi secara massal (jika menggunakan $guarded)
    // protected $guarded = ['id'];
}
