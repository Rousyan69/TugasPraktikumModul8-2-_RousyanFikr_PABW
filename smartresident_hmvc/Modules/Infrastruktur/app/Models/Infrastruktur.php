<?php

namespace Modules\Infrastruktur\Models;

use Illuminate\Database\Eloquent\Model;

class Infrastruktur extends Model
{
    protected $fillable = ['nama_aset', 'kategori', 'lokasi_dusun', 'kondisi', 'tahun_pengadaan'];
}