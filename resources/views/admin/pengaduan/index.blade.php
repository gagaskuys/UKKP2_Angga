@extends('layouts.app')
@section('title', 'Daftar Pengaduan')
@section('content')
    <h2 class="mb-4">💬 Daftar Semua Pengaduan</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>#</th><th>Pelapor</th><th>Judul</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($pengaduan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>
                            @php $warna = ['belum'=>'secondary','sedang'=>'warning','sudah'=>'success']; @endphp
                            <span class="badge bg-{{ $warna[$p->status] }}">{{ ucfirst($p->status) }}</span>
                        </td>
                        <td>{{ $p->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.pengaduan.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.pengaduan.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengaduan ini?')">
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