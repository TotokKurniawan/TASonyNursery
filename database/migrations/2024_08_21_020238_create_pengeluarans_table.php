<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Kolom untuk tanggal pengeluaran
            $table->integer('jumlah'); // Kolom untuk jumlah pengeluaran, dengan dua desimal
            $table->string('keterangan')->nullable(); // Kolom untuk keterangan pengeluaran, bisa null
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
