@extends('layouts.app')
@section('title', 'Tambah Aset Infrastruktur')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="mb-3">
            <a href="{{ route('infrastruktur.index') }}" class="text-decoration-none text-muted small fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Infrastruktur
            </a>
        </div>
        <div class="card-sr p-4 p-md-5">
            <h5 class="fw-bolder mb-1">Tambah Aset Infrastruktur Baru</h5>
            <p class="text-muted small mb-4">Lengkapi rincian fasilitas desa yang akan didaftarkan ke sistem.</p>

            <form method="POST" action="{{ route('infrastruktur.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Aset Infrastruktur *</label>
                    <input type="text" name="nama_aset" value="{{ old('nama_aset') }}" class="form-control @error('nama_aset') is-invalid @enderror" placeholder="Contoh: Jembatan Penghubung Dusun Utara">
                    @error('nama_aset') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Kategori Sarana *</label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach(['Jalan & Jembatan', 'Irigasi & Drainase', 'Penerangan Jalan (PJU)', 'Fasilitas Umum & Balai', 'Sarana Air Bersih'] as $kat)
                                <option value="{{ $kat }}" @selected(old('kategori') === $kat)>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Lokasi Dusun / Wilayah *</label>
                        <input type="text" name="lokasi_dusun" value="{{ old('lokasi_dusun') }}" class="form-control @error('lokasi_dusun') is-invalid @enderror" placeholder="Contoh: Dusun Sukamaju RW 03">
                        @error('lokasi_dusun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Kondisi Saat Ini *</label>
                        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
                            @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                                <option value="{{ $k }}" @selected(old('kondisi') === $k)>{{ $k }}</option>
                            @endforeach
                        </select>
                        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Tahun Pengadaan *</label>
                        <input type="number" name="tahun_pengadaan" value="{{ old('tahun_pengadaan', date('Y')) }}" class="form-control @error('tahun_pengadaan') is-invalid @enderror">
                        @error('tahun_pengadaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('infrastruktur.index') }}" class="btn btn-light border rounded-3 px-4">Batal</a>
                    <button type="submit" class="btn btn-sr-primary px-4">Simpan Aset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection