<?php

namespace Modules\Aduan\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    protected $fillable = ['nama_pelapor', 'judul_aduan', 'lokasi_detail', 'tingkat_urgensi', 'status', 'foto_bukti', 'nama_file'];
    protected $appends = ['foto_url'];

    protected function fotoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->foto_bukti ? asset('storage/'.$this->foto_bukti) : null);
    }
}