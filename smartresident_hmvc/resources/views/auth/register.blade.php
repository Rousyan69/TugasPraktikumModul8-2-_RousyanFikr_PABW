@extends('layouts.guest')
@section('title', 'Pendaftaran Warga')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="auth-card p-4 p-md-5">
            <div class="text-center mb-4">
                <h4 class="fw-bolder mb-1">Registrasi Akun Warga</h4>
                <p class="text-muted small mb-0">Daftarkan diri Anda untuk melaporkan kerusakan infrastruktur desa.</p>
            </div>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Lengkap Sesuai KTP</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Email Aktif</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row g-2 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-sr-primary w-100 mb-3">Buat Akun Warga</button>
            </form>

            <div class="text-center small text-muted">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection