@extends('admin.layouts.app')
@section('title', isset($socialLink) ? 'Bağlantı Düzenle' : 'Yeni Bağlantı')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ isset($socialLink) ? route('admin.social-links.update', $socialLink) : route('admin.social-links.store') }}" method="POST">
                    @csrf
                    @if(isset($socialLink))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Platform Adı <span class="text-danger">*</span></label>
                        <input type="text" name="platform" class="form-control @error('platform') is-invalid @enderror"
                               value="{{ old('platform', $socialLink->platform ?? '') }}" required placeholder="örn: Instagram">
                        @error('platform')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">İkon <span class="text-danger">*</span></label>
                        <select name="icon" class="form-select @error('icon') is-invalid @enderror" required id="iconSelect">
                            <option value="">İkon seçin...</option>
                            @php
                                $icons = [
                                    'instagram' => 'Instagram',
                                    'facebook' => 'Facebook',
                                    'twitter-x' => 'X (Twitter)',
                                    'tiktok' => 'TikTok',
                                    'youtube' => 'YouTube',
                                    'linkedin' => 'LinkedIn',
                                    'whatsapp' => 'WhatsApp',
                                    'telegram' => 'Telegram',
                                    'pinterest' => 'Pinterest',
                                    'snapchat' => 'Snapchat',
                                    'threads' => 'Threads',
                                    'discord' => 'Discord',
                                    'spotify' => 'Spotify',
                                    'globe' => 'Web Sitesi',
                                    'envelope-fill' => 'E-posta',
                                    'telephone-fill' => 'Telefon',
                                    'geo-alt-fill' => 'Konum',
                                ];
                            @endphp
                            @foreach($icons as $value => $label)
                                <option value="{{ $value }}" {{ old('icon', $socialLink->icon ?? '') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2" id="iconPreview">
                            @if(isset($socialLink))
                                <i class="bi bi-{{ $socialLink->icon }} fs-3"></i>
                                <span class="text-muted small ms-2">Önizleme</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">URL <span class="text-danger">*</span></label>
                        <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
                               value="{{ old('url', $socialLink->url ?? '') }}" required placeholder="https://instagram.com/hesapadiniz">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Durum</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $socialLink->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label">Aktif</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-accent">
                            <i class="bi bi-check-lg"></i> {{ isset($socialLink) ? 'Güncelle' : 'Kaydet' }}
                        </button>
                        <a href="{{ route('admin.social-links.index') }}" class="btn btn-outline-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('iconSelect').addEventListener('change', function() {
        const preview = document.getElementById('iconPreview');
        if (this.value) {
            preview.innerHTML = '<i class="bi bi-' + this.value + ' fs-3"></i><span class="text-muted small ms-2">Önizleme</span>';
        } else {
            preview.innerHTML = '';
        }
    });
</script>
@endpush
