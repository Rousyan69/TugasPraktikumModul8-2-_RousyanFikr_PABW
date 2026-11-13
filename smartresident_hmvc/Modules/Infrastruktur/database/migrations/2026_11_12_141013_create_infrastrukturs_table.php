<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('infrastrukturs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aset');
            $table->string('kategori');
            $table->string('lokasi_dusun');
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->year('tahun_pengadaan');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('infrastrukturs');
    }
};