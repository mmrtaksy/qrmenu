@extends('admin.layouts.app')
@section('title', 'Kullanıcılar')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Tüm Kullanıcılar</h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-accent btn-sm">
                <i class="bi bi-plus-lg"></i> Yeni Kullanıcı
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>E-posta</th>
                        <th>Kayıt Tarihi</th>
                        <th class="text-end">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="fw-semibold">
                            <i class="bi bi-person-circle me-1 text-muted"></i>
                            {{ $user->name }}
                            @if($user->id === auth()->id())
                                <span class="badge bg-primary bg-opacity-10 text-primary ms-1">Sen</span>
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td class="text-muted small">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
