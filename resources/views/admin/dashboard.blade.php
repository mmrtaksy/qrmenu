@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card p-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;background:rgba(255,158,129,.1);">
                    <i class="bi bi-collection-fill fs-4" style="color:#ff9e81;"></i>
                </div>
                <div>
                    <div class="text-muted small">Kategoriler</div>
                    <div class="fs-3 fw-bold">{{ $stats['categories'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;background:rgba(16,185,129,.1);">
                    <i class="bi bi-box-seam-fill fs-4" style="color:#10b981;"></i>
                </div>
                <div>
                    <div class="text-muted small">Toplam Ürün</div>
                    <div class="fs-3 fw-bold">{{ $stats['products'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;background:rgba(59,130,246,.1);">
                    <i class="bi bi-check-circle-fill fs-4" style="color:#3b82f6;"></i>
                </div>
                <div>
                    <div class="text-muted small">Aktif Ürün</div>
                    <div class="fs-3 fw-bold">{{ $stats['active_products'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-4">
            <h5 class="mb-3">Hızlı Erişim</h5>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i> Yeni Kategori Ekle
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i> Yeni Ürün Ekle
                </a>
                <a href="{{ route('menu') }}" target="_blank" class="btn btn-accent">
                    <i class="bi bi-phone"></i> Menüyü Gör
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4">
            <h5 class="mb-3">QR Kod</h5>
            <p class="text-muted small">Müşterileriniz aşağıdaki QR kodu okutarak menünüze ulaşabilir.</p>
            <div class="text-center" id="qrcode-container">
                <div id="qrcode" class="d-inline-block p-3 bg-white rounded-3 shadow-sm"></div>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-sm btn-outline-secondary" onclick="downloadQR()">
                    <i class="bi bi-download"></i> QR Kodu İndir
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    const qr = new QRCode(document.getElementById("qrcode"), {
        text: "{{ url('/') }}",
        width: 200,
        height: 200,
        colorDark: "#1a1a2e",
        colorLight: "#ffffff",
    });

    function downloadQR() {
        const canvas = document.querySelector('#qrcode canvas');
        const link = document.createElement('a');
        link.download = 'raqooncafe-qr.png';
        link.href = canvas.toDataURL();
        link.click();
    }
</script>
@endpush
