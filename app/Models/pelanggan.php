<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'latitude',
        'longitude',
        'id_user'
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);  // Pelanggan dimiliki oleh User
    }
}
