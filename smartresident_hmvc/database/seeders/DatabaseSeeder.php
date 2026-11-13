<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Aduan\Models\Aduan;
use Modules\Infrastruktur\Models\Infrastruktur;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Default Login
        User::create([
            'name' => 'Admin Perangkat Desa',
            'email' => 'admin@smartresident.id',
            'role' => UserRole::Admin,
            'password' => 'password',
        ]);

        User::create([
            'name' => 'Rousyan Fikr',
            'email' => 'warga@smartresident.id',
            'role' => UserRole::Warga,
            'password' => 'password',
        ]);

        // 2. Data Dummy Aset Infrastruktur (8 Data)
        $asetList = [
            ['nama_aset' => 'Jembatan Penghubung Dusun Utara', 'kategori' => 'Jalan & Jembatan', 'lokasi_dusun' => 'Dusun Krajan RW 01', 'kondisi' => 'Rusak Ringan', 'tahun_pengadaan' => 2019],
            ['nama_aset' => 'Saluran Irigasi Sawah Blok Timur', 'kategori' => 'Irigasi & Drainase', 'lokasi_dusun' => 'Dusun Sukamaju RW 03', 'kondisi' => 'Baik', 'tahun_pengadaan' => 2022],
            ['nama_aset' => 'Lampu PJU Tenaga Surya Jl. Merdeka', 'kategori' => 'Penerangan Jalan (PJU)', 'lokasi_dusun' => 'Dusun Mekarsari RW 02', 'kondisi' => 'Rusak Berat', 'tahun_pengadaan' => 2020],
            ['nama_aset' => 'Balai Pertemuan Warga & Posyandu', 'kategori' => 'Fasilitas Umum & Balai', 'lokasi_dusun' => 'Dusun Krajan RW 02', 'kondisi' => 'Baik', 'tahun_pengadaan' => 2021],
            ['nama_aset' => 'Sumur Bor & Menara Air Pamsimas', 'kategori' => 'Sarana Air Bersih', 'lokasi_dusun' => 'Dusun Cibogo RW 04', 'kondisi' => 'Baik', 'tahun_pengadaan' => 2023],
            ['nama_aset' => 'Jalan Beton Poros Desa', 'kategori' => 'Jalan & Jembatan', 'lokasi_dusun' => 'Dusun Sukamaju RW 01', 'kondisi' => 'Rusak Ringan', 'tahun_pengadaan' => 2018],
            ['nama_aset' => 'Gorong-Gorong Simpang Tiga', 'kategori' => 'Irigasi & Drainase', 'lokasi_dusun' => 'Dusun Mekarsari RW 05', 'kondisi' => 'Rusak Berat', 'tahun_pengadaan' => 2017],
            ['nama_aset' => 'Taman Baca & Wi-Fi Publik Desa', 'kategori' => 'Fasilitas Umum & Balai', 'lokasi_dusun' => 'Dusun Krajan RW 01', 'kondisi' => 'Baik', 'tahun_pengadaan' => 2024],
        ];

        foreach ($asetList as $aset) {
            Infrastruktur::create($aset);
        }

        // 3. Data Dummy Aduan Warga (6 Data)
        $aduanList = [
            ['nama_pelapor' => 'Rousyan Fikr', 'judul_aduan' => 'Lampu PJU Mati Total di Pertigaan', 'lokasi_detail' => 'Jl. Merdeka RT 04 / RW 02', 'tingkat_urgensi' => 'Tinggi', 'status' => 'Menunggu'],
            ['nama_pelapor' => 'Ahmad Fauzi', 'judul_aduan' => 'Aspal Berlubang Cukup Dalam', 'lokasi_detail' => 'Depan Balai Dusun Sukamaju', 'tingkat_urgensi' => 'Tinggi', 'status' => 'Diproses'],
            ['nama_pelapor' => 'Siti Aminah', 'judul_aduan' => 'Saluran Drainase Tersumbat Sampah', 'lokasi_detail' => 'Gang Melati RT 02 / RW 01', 'tingkat_urgensi' => 'Sedang', 'status' => 'Diproses'],
            ['nama_pelapor' => 'Budi Santoso', 'judul_aduan' => 'Pagar Pengaman Jembatan Berkarat', 'lokasi_detail' => 'Jembatan Dusun Utara', 'tingkat_urgensi' => 'Sedang', 'status' => 'Menunggu'],
            ['nama_pelapor' => 'Dewi Lestari', 'judul_aduan' => 'Kran Air Umum Pamsimas Bocor', 'lokasi_detail' => 'Dusun Cibogo RT 01 / RW 04', 'tingkat_urgensi' => 'Rendah', 'status' => 'Selesai'],
            ['nama_pelapor' => 'Hendra Wijaya', 'judul_aduan' => 'Pohon Tumbang Menutup Bahu Jalan', 'lokasi_detail' => 'Jalan Poros Desa KM 2', 'tingkat_urgensi' => 'Tinggi', 'status' => 'Selesai'],
        ];

        foreach ($aduanList as $aduan) {
            Aduan::create($aduan);
        }
    }
}