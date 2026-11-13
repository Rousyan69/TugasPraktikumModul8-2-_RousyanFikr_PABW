@extends('layouts.app')
@section('title', 'Dashboard Desa')

@section('content')
<div class="card-sr p-4 mb-4 border-0 text-white" style="background: linear-gradient(135deg, #065f46 0%, #059669 60%, #10b981 100%);">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <span class="badge bg-white text-success fw-bold mb-2 px-3 py-1 rounded-pill">{{ auth()->user()->role->label() }}</span>
            <h3 class="fw-bolder mb-1">Selamat Datang, {{ auth()->user()->name }}!</h3>
            <p class="mb-0 opacity-90 small">Pantau kondisi fasilitas umum desa dan tindak lanjuti laporan warga secara terpadu.</p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <a href="{{ route('aduan.index') }}" class="btn btn-light text-success fw-bold rounded-3 px-4 py-2 shadow-sm">
                <i class="bi bi-megaphone-fill me-1"></i> Lapor Kerusakan
            </a>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card-sr p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small fw-semibold">Total Aset Desa</div>
                    <div class="fs-2 fw-bolder mt-1">{{ $totalAset }}</div>
                </div>
                <span class="p-2 rounded-3 badge-soft-success"><i class="bi bi-buildings fs-4"></i></span>
            </div>
            <div class="small text-muted mt-2">Terdata dalam inventaris</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-sr p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small fw-semibold">Aset Perlu Perbaikan</div>
                    <div class="fs-2 fw-bolder mt-1 text-warning">{{ $asetRusak }}</div>
                </div>
                <span class="p-2 rounded-3 badge-soft-warning"><i class="bi bi-tools fs-4"></i></span>
            </div>
            <div class="small text-muted mt-2">Rusak ringan & berat</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-sr p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small fw-semibold">Total Aduan Warga</div>
                    <div class="fs-2 fw-bolder mt-1">{{ $totalAduan }}</div>
                </div>
                <span class="p-2 rounded-3 badge-soft-info"><i class="bi bi-chat-square-text fs-4"></i></span>
            </div>
            <div class="small text-muted mt-2">Laporan masuk sistem</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-sr p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small fw-semibold">Prioritas Tinggi</div>
                    <div class="fs-2 fw-bolder mt-1 text-danger">{{ $aduanUrgensiTinggi }}</div>
                </div>
                <span class="p-2 rounded-3 badge-soft-danger"><i class="bi bi-exclamation-triangle fs-4"></i></span>
            </div>
            <div class="small text-muted mt-2">Belum terselesaikan</div>
        </div>
    </div>
</div>

<div class="card-sr overflow-hidden">
    <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center bg-white">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history text-success me-2"></i>Laporan Aduan Terbaru</h6>
        <a href="{{ route('aduan.index') }}" class="small fw-bold text-success text-decoration-none">Kelola Semua <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="table-responsive">
        <table class="table table-sr align-middle mb-0">
            <thead>
                <tr>
                    <th>Pelapor</th>
                    <th>Judul Aduan</th>
                    <th>Lokasi</th>
                    <th>Urgensi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aduanTerbaru as $item)
                <tr>
                    <td class="fw-semibold">{{ $item->nama_pelapor }}</td>
                    <td>{{ $item->judul_aduan }}</td>
                    <td class="text-muted">{{ $item->lokasi_detail }}</td>
                    <td>
                        <span class="badge rounded-pill {{ $item->tingkat_urgensi === 'Tinggi' ? 'badge-soft-danger' : ($item->tingkat_urgensi === 'Sedang' ? 'badge-soft-warning' : 'badge-soft-info') }}">
                            {{ $item->tingkat_urgensi }}
                        </span>
                    </td>
                    <td>
                        <span class="badge rounded-pill {{ $item->status === 'Selesai' ? 'badge-soft-success' : ($item->status === 'Diproses' ? 'badge-soft-info' : 'badge-soft-slate') }}">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada laporan aduan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection