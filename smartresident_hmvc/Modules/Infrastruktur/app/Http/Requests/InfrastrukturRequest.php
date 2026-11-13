<?php

namespace Modules\Infrastruktur\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfrastrukturRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->isAdmin() ?? false; }

    public function rules(): array
    {
        return [
            'nama_aset' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'lokasi_dusun' => 'required|string|max:255',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tahun_pengadaan' => 'required|digits:4|integer|min:1990|max:2026',
        ];
    }
}