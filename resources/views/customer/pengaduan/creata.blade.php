@extends('layouts.app')
@section('title', 'Buat Pengaduan')
@section('content')
<h2 class="mb-4">📝 Buat Pengaduan Baru</h2>
<div class="card shadow-sm">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('customer.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul Pengaduan</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Contoh: Kerusakan Fasilitas Toilet" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Keluhan</label>
                <textarea name="keluhan" class="form-control" rows="5" placeholder="Jelaskan detail keluhan Anda di sini..." required>{{ old('keluhan') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Bukti (Opsional)</label>
                <input type="file" name="foto_bukti" class="form-control" accept="image/*">
                <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Kirim Pengaduan
                </button>
                <a href="{{ route('customer.pengaduan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection