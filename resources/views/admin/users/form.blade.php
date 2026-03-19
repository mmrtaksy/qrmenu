@extends('admin.layouts.app')
@section('title', isset($user) ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ad Soyad <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">E-posta <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email ?? '') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(!isset($user))
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Şifre <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Şifre Tekrar <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-accent">
                            <i class="bi bi-check-lg"></i> {{ isset($user) ? 'Güncelle' : 'Kaydet' }}
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
