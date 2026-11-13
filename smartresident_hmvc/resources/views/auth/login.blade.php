@extends('layouts.guest')
@section('title', 'Masuk Portal')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="auth-card p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3 text-white" style="width:52px;height:52px;background:linear-gradient(135deg,#10b981,#047857);box-shadow:0 8px 16px rgba(5,150,105,.25);">
                    <i class="bi bi-buildings-fill fs-3"></i>
                </div>
                <h4 class="fw-bolder mb-1">SmartResident</h4>
                <p class="text-muted small mb-0">Portal Pelaporan Infrastruktur & Fasilitas Desa</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="admin@smartresident.id" required autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-sr-primary w-100 mb-3">
                    Masuk ke Sistem <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            <div class="text-center small text-muted">
                Warga baru? <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Daftar Akun Warga</a>
            </div>
        </div>
    </div>
</div>
@endsection