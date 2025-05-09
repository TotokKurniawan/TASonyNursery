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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('budget',); // Budget with 2 decimal points
            $table->string('spesifikasi_lahan'); // Dimensions of the area (could be stored as a string)
            $table->enum('status', ['pending', 'in_progress', 'completed', 'canceled', 'negosiasi', 'in progress (bayar dp)', 'in progress (survei)', 'in progress (pembuatan taman)'])->default('pending'); // Enum for status
            $table->string('request_bunga')->nullable(); // Requested flower details, nullable
            $table->string('foto_lokasi')->nullable(); // Path to location photo, nullable
            $table->string('foto_desain')->nullable(); // Path to design photo, nullable
            $table->string('metode_pembayaran'); // Payment method
            $table->string('tanggal_selesai')->nullable(); // Payment method
            $table->date('tanggal_survei')->nullable(); // Payment method
            $table->string('keterangan_tambahan')->nullable(); // Payment metho
            $table->string('keterangan_tolak')->nullable(); // Payment method
            $table->enum('status_pembayaran', ['belum lunas', 'dp', 'lunas', 'dp lunas', 'konfirmasi dp'])->default('pending');
            $table->integer('nominal_dp')->nullable(); // Payment method
            $table->string('bukti_dp')->nullable(); // Payment method
            $table->unsignedBigInteger('id_pelanggan'); // Foreign key for 'pelanggan' (customer)
            $table->unsignedBigInteger('id_desain')->nullable(); // Foreign key for 'desain' (design), nullable
            $table->timestamps(); // Created_at and updated_at columns

            // Set foreign key constraints (assuming you have 'pelanggans' and 'desains' tables)
            $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->foreign('id_desain')->references('id')->on('desains')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
