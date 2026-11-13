<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('judul_aduan');
            $table->string('lokasi_detail');
            $table->enum('tingkat_urgensi', ['Rendah', 'Sedang', 'Tinggi'])->default('Sedang');
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu');
            $table->string('foto_bukti')->nullable();
            $table->string('nama_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('aduans');
    }
};