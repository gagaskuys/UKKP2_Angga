@extends('layouts.app')
@section('title', 'Edit Pengaduan')
@section('content')
    <h2 class="mb-4">✏️ Edit Pengaduan</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengaduan->judul) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keluhan</label>
                    <textarea name="keluhan" class="form-control" rows="4" required>{{ old('keluhan', $pengaduan->keluhan) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="belum" {{ old('status', $pengaduan->status) == 'belum' ? 'selected' : '' }}>Belum Ditangani</option>
                        <option value="sedang" {{ old('status', $pengaduan->status) == 'sedang' ? 'selected' : '' }}>Sedang Ditangani</option>
                        <option value="sudah" {{ old('status', $pengaduan->status) == 'sudah' ? 'selected' : '' }}>Sudah Ditangani</option>
                    </select>
                </div>
                @if($pengaduan->foto_bukti)
                    <div class="mb-3">
                        <label class="form-label">Foto Bukti</label><br>
                        <img src="{{ asset('storage/'.$pengaduan->foto_bukti) }}" class="img-thumbnail" style="max-height:200px">
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection