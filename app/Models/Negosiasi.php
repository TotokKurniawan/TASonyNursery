<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negosiasi extends Model
{
    use HasFactory;
    protected $table = 'negosiasi';
    protected $fillable = ['id_pelanggan', 'id_user', 'id_pesanan', 'pesan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }


    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
