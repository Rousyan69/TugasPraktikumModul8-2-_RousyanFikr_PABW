@extends('layouts.app')
@section('title', 'Aset Infrastruktur Desa')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h4 class="fw-bolder mb-1">Inventaris Infrastruktur Desa</h4>
        <p class="text-muted small mb-0">Daftar fasilitas umum, jalan, jembatan, dan sarana publik desa.</p>
    </div>
    @if(auth()->user()->isAdmin())
        <a href="{{ route('infrastruktur.create') }}" class="btn btn-sr-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Aset Baru
        </a>
    @endif
</div>

<div class="card-sr p-3 mb-4">
    <form method="GET" action="{{ route('infrastruktur.index') }}" class="row g-2 align-items-center">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ $search }}" class="form-control border-start-0" placeholder="Cari nama aset atau lokasi dusun...">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-dark rounded-3 px-3">Cari Data</button>
            @if($search)
                <a href="{{ route('infrastruktur.index') }}" class="btn btn-light border rounded-3">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="card-sr overflow-hidden">
    <div class="table-responsive">
        <table class="table table-sr table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Lokasi Dusun</th>
                    <th>Kondisi</th>
                    <th>Tahun Pengadaan</th>
                    @if(auth()->user()->isAdmin()) <th class="text-end">Aksi</th> @endif
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td class="fw-bold text-dark">{{ $item->nama_aset }}</td>
                    <td><span class="badge badge-soft-slate rounded-pill">{{ $item->kategori }}</span></td>
                    <td class="text-muted"><i class="bi bi-geo-alt me-1 text-success"></i>{{ $item->lokasi_dusun }}</td>
                    <td>
                        @php
                            $badge = match($item->kondisi) {
                                'Baik' => 'badge-soft-success',
                                'Rusak Ringan' => 'badge-soft-warning',
                                'Rusak Berat' => 'badge-soft-danger',
                            };
                        @endphp
                        <span class="badge rounded-pill {{ $badge }}">{{ $item->kondisi }}</span>
                    </td>
                    <td class="fw-semibold">{{ $item->tahun_pengadaan }}</td>
                    @if(auth()->user()->isAdmin())
                    <td class="text-end text-nowrap">
                        <a href="{{ route('infrastruktur.edit', $item) }}" class="btn btn-sm btn-outline-primary rounded-3" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('infrastruktur.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aset {{ $item->nama_aset }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="Hapus">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                        Belum ada data infrastruktur yang tercatat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($data->hasPages())
        <div class="p-3 bg-white border-top">{{ $data->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection