@extends('admin.layouts.app')
@section('title', 'Şifre Değiştir')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;background:rgba(255,158,129,.1);">
                        <i class="bi bi-key-fill fs-3" style="color:#ff9e81;"></i>
                    </div>
                    <h5>Şifre Değiştir</h5>
                    <p class="text-muted small">{{ auth()->user()->email }}</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.change-password') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mevcut Şifre <span class="text-danger">*</span></label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Yeni Şifre <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                        <div class="form-text">En az 6 karakter olmalıdır.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Yeni Şifre Tekrar <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-accent">
                            <i class="bi bi-check-lg"></i> Şifreyi Güncelle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
