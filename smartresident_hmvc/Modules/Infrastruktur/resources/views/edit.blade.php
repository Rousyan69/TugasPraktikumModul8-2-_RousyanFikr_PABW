@extends('layouts.app')
@section('title', 'Edit Aset Infrastruktur')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="mb-3">
            <a href="{{ route('infrastruktur.index') }}" class="text-decoration-none text-muted small fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Infrastruktur
            </a>
        </div>
        <div class="card-sr p-4 p-md-5">
            <h5 class="fw-bolder mb-1">Perbarui Data Aset Infrastruktur</h5>
            <p class="text-muted small mb-4">Ubah informasi kondisi atau detail lokasi aset desa.</p>

            <form method="POST" action="{{ route('infrastruktur.update', $infrastruktur) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Aset Infrastruktur *</label>
                    <input type="text" name="nama_aset" value="{{ old('nama_aset', $infrastruktur->nama_aset) }}" class="form-control @error('nama_aset') is-invalid @enderror">
                    @error('nama_aset') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Kategori Sarana *</label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                            @foreach(['Jalan & Jembatan', 'Irigasi & Drainase', 'Penerangan Jalan (PJU)', 'Fasilitas Umum & Balai', 'Sarana Air Bersih'] as $kat)
                                <option value="{{ $kat }}" @selected(old('kategori', $infrastruktur->kategori) === $kat)>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Lokasi Dusun / Wilayah *</label>
                        <input type="text" name="lokasi_dusun" value="{{ old('lokasi_dusun', $infrastruktur->lokasi_dusun) }}" class="form-control @error('lokasi_dusun') is-invalid @enderror">
                        @error('lokasi_dusun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Kondisi Saat Ini *</label>
                        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
                            @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                                <option value="{{ $k }}" @selected(old('kondisi', $infrastruktur->kondisi) === $k)>{{ $k }}</option>
                            @endforeach
                        </select>
                        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Tahun Pengadaan *</label>
                        <input type="number" name="tahun_pengadaan" value="{{ old('tahun_pengadaan', $infrastruktur->tahun_pengadaan) }}" class="form-control @error('tahun_pengadaan') is-invalid @enderror">
                        @error('tahun_pengadaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('infrastruktur.index') }}" class="btn btn-light border rounded-3 px-4">Batal</a>
                    <button type="submit" class="btn btn-sr-primary px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection