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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // Menetapkan panjang maksimum 255 karakter
            $table->string('email', 255)->unique(); // Menetapkan panjang maksimum 255 karakter dan unique index
            $table->string('password');
            $table->string('foto')->nullable(); // Menambahkan kolom untuk menyimpan path foto profil
            $table->enum('role', ['admin', 'user'])->default('user'); // Kolom role untuk menentukan peran pengguna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
