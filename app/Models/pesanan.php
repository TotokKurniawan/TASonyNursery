<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    // Tentukan nama tabel jika tidak sesuai konvensi penamaan
    protected $table = 'pesanans'; // Nama tabel dalam database

    // Tentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'budget',
        'spesifikasi_lahan',
        'status',
        'request_bunga',
        'foto_lokasi',
        'foto_desain',
        'metode_pembayaran',
        'tanggal_selesai',
        'tanggal_survei',
        'keterangan_tambahan',
        'keterangan_tolak',
        'status_pembayaran',
        'nominal_dp',
        'bukti_dp',
        'id_pelanggan',
        'id_desain',
    ];
    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class, 'id_pelanggan', 'id');
    }
    public function desain()
    {
        return $this->belongsTo(desain::class, 'id_desain', 'id');
    }
    public function negosiasi()
    {
        return $this->hasMany(Negosiasi::class, 'id_pesanan');
    }
}
