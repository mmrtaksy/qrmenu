@extends('admin.layouts.app')
@section('title', isset($product) ? 'Ürün Düzenle' : 'Yeni Ürün')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">
<style>
    .cropper-container { max-height: 400px; }
    .image-preview { max-width: 100%; max-height: 300px; }
    #cropModal .modal-body { background: #f8f9fa; }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form id="productForm" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <input type="hidden" name="cropped_image" id="croppedImageInput">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Kategori seçin...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ürün Adı <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name ?? '') }}" required placeholder="örn: Serpme Kahvaltı">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Açıklama</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Ürün hakkında kısa açıklama...">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fiyat (TL) <span class="text-danger">*</span></label>
                        <input type="number" name="price" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', $product->price ?? '') }}" required placeholder="0.00">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ürün Görseli</label>
                        @if(isset($product) && $product->image)
                            <div class="mb-2" id="currentImage">
                                <img src="{{ asset('storage/' . $product->image) }}" class="rounded" style="height:100px;">
                                <small class="text-muted d-block mt-1">Yeni görsel yüklerseniz mevcut görsel değiştirilir.</small>
                            </div>
                        @endif
                        <input type="file" id="imageInput" class="form-control" accept="image/*">
                        <div id="previewContainer" class="mt-3 d-none">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-success">Kırpılmış Görsel</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openCropModal()">Yeniden Kırp</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">Kaldır</button>
                            </div>
                            <img id="croppedPreview" class="rounded shadow-sm" style="max-height:150px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Durum</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label">Aktif</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-accent">
                            <i class="bi bi-check-lg"></i> {{ isset($product) ? 'Güncelle' : 'Kaydet' }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Crop Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Görseli Kırp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="cropImage" class="image-preview">
            </div>
            <div class="modal-footer">
                <div class="d-flex gap-2 me-auto">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cropper.setAspectRatio(1)">1:1</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cropper.setAspectRatio(4/3)">4:3</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cropper.setAspectRatio(16/9)">16:9</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cropper.setAspectRatio(NaN)">Serbest</button>
                </div>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">İptal</button>
                <button type="button" class="btn btn-accent" onclick="applyCrop()">Kırp ve Uygula</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script>
    let cropper = null;
    let originalImageSrc = null;
    const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));

    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            originalImageSrc = event.target.result;
            openCropModal();
        };
        reader.readAsDataURL(file);
    });

    function openCropModal() {
        if (!originalImageSrc) return;
        const cropImage = document.getElementById('cropImage');
        cropImage.src = originalImageSrc;
        cropModal.show();

        document.getElementById('cropModal').addEventListener('shown.bs.modal', function() {
            if (cropper) cropper.destroy();
            cropper = new Cropper(cropImage, {
                aspectRatio: 1,
                viewMode: 2,
                autoCropArea: 0.8,
                responsive: true,
            });
        }, { once: true });
    }

    function applyCrop() {
        if (!cropper) return;
        const canvas = cropper.getCroppedCanvas({
            maxWidth: 800,
            maxHeight: 800,
            imageSmoothingQuality: 'high',
        });
        const dataUrl = canvas.toDataURL('image/jpeg', 0.85);
        document.getElementById('croppedImageInput').value = dataUrl;
        document.getElementById('croppedPreview').src = dataUrl;
        document.getElementById('previewContainer').classList.remove('d-none');
        cropModal.hide();
    }

    function removeImage() {
        document.getElementById('croppedImageInput').value = '';
        document.getElementById('previewContainer').classList.add('d-none');
        document.getElementById('imageInput').value = '';
        originalImageSrc = null;
    }
</script>
@endpush
