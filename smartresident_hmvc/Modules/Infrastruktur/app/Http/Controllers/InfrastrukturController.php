<?php

namespace Modules\Infrastruktur\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Infrastruktur\Http\Requests\InfrastrukturRequest;
use Modules\Infrastruktur\Models\Infrastruktur;

class InfrastrukturController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Infrastruktur::when($search, fn($q) => $q->where('nama_aset', 'like', "%{$search}%")->orWhere('lokasi_dusun', 'like', "%{$search}%"))
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('infrastruktur::index', compact('data', 'search'));
    }

    public function create()
    {
        return view('infrastruktur::create');
    }

    public function store(InfrastrukturRequest $request)
    {
        Infrastruktur::create($request->validated());
        return redirect()->route('infrastruktur.index')->with('success', 'Data aset infrastruktur berhasil ditambahkan.');
    }

    public function edit(Infrastruktur $infrastruktur)
    {
        return view('infrastruktur::edit', compact('infrastruktur'));
    }

    public function update(InfrastrukturRequest $request, Infrastruktur $infrastruktur)
    {
        $infrastruktur->update($request->validated());
        return redirect()->route('infrastruktur.index')->with('success', 'Data aset infrastruktur berhasil diperbarui.');
    }

    public function destroy(Infrastruktur $infrastruktur)
    {
        $infrastruktur->delete();
        return redirect()->route('infrastruktur.index')->with('success', 'Data aset infrastruktur berhasil dihapus.');
    }
}