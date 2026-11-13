<?php

namespace Modules\Aduan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Modules\Aduan\Http\Requests\AduanRequest;
use Modules\Aduan\Models\Aduan;

class AduanController extends Controller
{
    public function index()
    {
        return view('aduan::index');
    }

    public function getData(): JsonResponse
    {
        return response()->json(Aduan::latest()->get());
    }

    public function store(AduanRequest $request): JsonResponse
    {
        $data = $request->safe()->except('foto_bukti');
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $data['foto_bukti'] = $file->store('bukti_aduan', 'public');
            $data['nama_file'] = $file->getClientOriginalName();
        }

        Aduan::create($data);
        return response()->json(['success' => 'Laporan aduan warga berhasil dikirim.']);
    }

    public function edit(Aduan $aduan): JsonResponse
    {
        return response()->json($aduan);
    }

    public function update(AduanRequest $request, Aduan $aduan): JsonResponse
    {
        $data = $request->safe()->except('foto_bukti');
        if ($request->hasFile('foto_bukti')) {
            if ($aduan->foto_bukti) {
                Storage::disk('public')->delete($aduan->foto_bukti);
            }
            $file = $request->file('foto_bukti');
            $data['foto_bukti'] = $file->store('bukti_aduan', 'public');
            $data['nama_file'] = $file->getClientOriginalName();
        }

        $aduan->update($data);
        return response()->json(['success' => 'Data aduan berhasil diperbarui.']);
    }

    public function destroy(Aduan $aduan): JsonResponse
    {
        if ($aduan->foto_bukti) {
            Storage::disk('public')->delete($aduan->foto_bukti);
        }
        $aduan->delete();
        return response()->json(['success' => 'Data aduan dan berkas berhasil dihapus.']);
    }
}