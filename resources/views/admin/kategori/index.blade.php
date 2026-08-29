@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🏷️ Manajemen Kategori</h2>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Kategori</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>#</th><th>Nama Kategori</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($kategori as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>{{ $k->deskripsi ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.kategori.edit', $k) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection