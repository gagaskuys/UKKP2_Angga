@extends('layouts.app')
@section('title', 'Penanganan Pengaduan')
@section('content')
    <h2 class="mb-4">💬 Daftar Pengaduan Masuk</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr><th>#</th><th>Pelapor</th><th>Judul</th><th>Status</th><th>Tanggal</th><th>Ubah Status</th></tr>
                </thead>
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
                            <!-- Form inline untuk ubah status dengan cepat -->
                            <form action="{{ route('petugas.pengaduan.status', $p) }}" method="POST" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <select name="status" class="form-select form-select-sm" style="width: 130px;">
                                    <option value="belum" {{ $p->status == 'belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="sedang" {{ $p->status == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="sudah" {{ $p->status == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection