@extends('admin.layouts.app')
@section('title', 'Ürünler')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Tüm Ürünler</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-accent btn-sm">
                <i class="bi bi-plus-lg"></i> Yeni Ürün
            </a>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                Henüz ürün eklenmemiş.
            </div>
        @else
            <p class="text-muted small mb-3"><i class="bi bi-arrows-move"></i> Sıralamayı değiştirmek için satırları sürükleyip bırakın.</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:40px"></th>
                            <th>Görsel</th>
                            <th>Ürün Adı</th>
                            <th>Kategori</th>
                            <th>Fiyat</th>
                            <th>Durum</th>
                            <th class="text-end">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody id="sortableProducts">
                        @foreach($products as $product)
                        <tr data-id="{{ $product->id }}">
                            <td><i class="bi bi-grip-vertical drag-handle fs-5"></i></td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="" class="rounded" style="width:48px;height:48px;object-fit:cover;">
                                @else
                                    <div class="rounded d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#f3f4f6;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $product->category->name }}</span></td>
                            <td class="fw-semibold">{{ number_format($product->price, 2) }} TL</td>
                            <td>
                                <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Pasif' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    new Sortable(document.getElementById('sortableProducts'), {
        handle: '.drag-handle',
        animation: 200,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            const ids = [...document.querySelectorAll('#sortableProducts tr')].map(r => parseInt(r.dataset.id));
            fetch('{{ route("admin.products.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ ids })
            });
        }
    });
</script>
@endpush
