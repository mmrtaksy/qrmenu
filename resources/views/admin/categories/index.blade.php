@extends('admin.layouts.app')
@section('title', 'Kategoriler')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Tüm Kategoriler</h5>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-accent btn-sm">
                <i class="bi bi-plus-lg"></i> Yeni Kategori
            </a>
        </div>

        @if($categories->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-collection fs-1 d-block mb-2"></i>
                Henüz kategori eklenmemiş.
            </div>
        @else
            <p class="text-muted small mb-3"><i class="bi bi-arrows-move"></i> Sıralamayı değiştirmek için satırları sürükleyip bırakın.</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:40px"></th>
                            <th>Görsel</th>
                            <th>Kategori Adı</th>
                            <th>Ürün Sayısı</th>
                            <th>Durum</th>
                            <th class="text-end">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody id="sortableCategories">
                        @foreach($categories as $category)
                        <tr data-id="{{ $category->id }}">
                            <td><i class="bi bi-grip-vertical drag-handle fs-5"></i></td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="" class="rounded" style="width:48px;height:48px;object-fit:cover;">
                                @else
                                    <div class="rounded d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#f3f4f6;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td>{{ $category->products_count }} ürün</td>
                            <td>
                                <span class="badge {{ $category->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $category->is_active ? 'Aktif' : 'Pasif' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kategoriyi silmek istediğinize emin misiniz? Alt ürünler de silinecektir.')">
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
    new Sortable(document.getElementById('sortableCategories'), {
        handle: '.drag-handle',
        animation: 200,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            const ids = [...document.querySelectorAll('#sortableCategories tr')].map(r => parseInt(r.dataset.id));
            fetch('{{ route("admin.categories.reorder") }}', {
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
