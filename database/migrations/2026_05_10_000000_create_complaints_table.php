<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->date('reported_at');
            $table->string('nama')->nullable();
            $table->string('kontak');
            $table->text('wilayah');
            $table->string('jenis_kelamin');
            $table->string('usia');
            $table->string('tingkat_khawatir');
            $table->string('kategori')->nullable();
            $table->string('jenis_pelapor')->nullable();
            $table->string('tempat_kejadian')->nullable();
            $table->string('waktu_kejadian')->nullable();
            $table->string('pelaku')->nullable();
            $table->text('kronologi')->nullable();
            $table->text('saran')->nullable();
            $table->enum('status', ['Belum Diproses', 'Sedang Diproses', 'Selesai', 'Ditolak'])->default('Belum Diproses');
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
