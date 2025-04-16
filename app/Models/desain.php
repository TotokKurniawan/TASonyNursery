<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desain extends Model
{
    use HasFactory;
    protected $table = 'desains'; // Nama tabel dalam database

    // Tentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'konsep',
        'lahan',
        'harga',
        'foto',
    ];
}
