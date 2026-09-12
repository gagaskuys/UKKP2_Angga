@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')
<div class="container">
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
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Contoh: Kerusakan Fasilitas" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kategori Pengaduan</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Isi Keluhan</label>
                    <textarea name="keluhan" class="form-control" rows="5" placeholder="Jelaskan detail keluhan Anda..." required>{{ old('keluhan') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Foto Bukti (Opsional)</label>
                    <input type="file" name="foto_bukti" class="form-control" accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                <a href="{{ route('customer.pengaduan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection