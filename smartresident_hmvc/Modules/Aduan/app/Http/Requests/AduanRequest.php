<?php

namespace Modules\Aduan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AduanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $aduan = $this->route('aduan');
        return [
            'nama_pelapor' => 'required|string|max:255',
            'judul_aduan' => 'required|string|max:255',
            'lokasi_detail' => 'required|string|max:255',
            'tingkat_urgensi' => 'required|in:Rendah,Sedang,Tinggi',
            'status' => 'required|in:Menunggu,Diproses,Selesai',
            'foto_bukti' => [$aduan ? 'nullable' : 'required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'foto_bukti.required' => 'Foto atau dokumen bukti kerusakan wajib diunggah.',
            'foto_bukti.mimes' => 'Format file harus jpg, jpeg, png, atau pdf.',
            'foto_bukti.max' => 'Ukuran file maksimal 2 MB.',
        ];
    }
}