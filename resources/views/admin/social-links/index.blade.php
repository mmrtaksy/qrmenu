@extends('admin.layouts.app')
@section('title', 'Sosyal Medya')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Sosyal Medya Bağlantıları</h5>
            <a href="{{ route('admin.social-links.create') }}" class="btn btn-accent btn-sm">
                <i class="bi bi-plus-lg"></i> Yeni Bağlantı
            </a>
        </div>

        @if($links->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-share fs-1 d-block mb-2"></i>
                Henüz sosyal medya bağlantısı eklenmemiş.
            </div>
        @else
            <p class="text-muted small mb-3"><i class="bi bi-arrows-move"></i> Sıralamayı değiştirmek için satırları sürükleyip bırakın.</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:40px"></th>
                            <th>İkon</th>
                            <th>Platform</th>
                            <th>URL</th>
                            <th>Durum</th>
                            <th class="text-end">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody id="sortableSocialLinks">
                        @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td><i class="bi bi-grip-vertical drag-handle fs-5"></i></td>
                            <td><i class="bi bi-{{ $link->icon }} fs-4"></i></td>
                            <td class="fw-semibold">{{ $link->platform }}</td>
                            <td>
                                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none small">
                                    {{ Str::limit($link->url, 40) }} <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </td>
                            <td>
                                <span class="badge {{ $link->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $link->is_active ? 'Aktif' : 'Pasif' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.social-links.edit', $link) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu bağlantıyı silmek istediğinize emin misiniz?')">
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
    new Sortable(document.getElementById('sortableSocialLinks'), {
        handle: '.drag-handle',
        animation: 200,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            const ids = [...document.querySelectorAll('#sortableSocialLinks tr')].map(r => parseInt(r.dataset.id));
            fetch('{{ route("admin.social-links.reorder") }}', {
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
