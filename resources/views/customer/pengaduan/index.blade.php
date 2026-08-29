@extends('layouts.app')
@section('title', 'Pengaduan Saya')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 Daftar Pengaduan Saya</h2>
    <a href="{{ route('customer.pengaduan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Buat Pengaduan Baru
    </a>
</div>

<div class="row g-3">
    @forelse($pengaduan as $p)
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title mb-0">{{ $p->judul }}</h5>
                    @php
                    $warna = ['belum' => 'secondary', 'sedang' => 'warning', 'sudah' => 'success'];
                    @endphp
                    <span class="badge bg-{{ $warna[$p->status] }} px-3 py-2">
                        {{ ucfirst($p->status) }}
                    </span>
                </div>
                <p class="text-muted small mb-2">
                    <i class="bi bi-calendar"></i> {{ $p->created_at->format('d M Y, H:i') }}
                </p>
                <p class="card-text">{{ Str::limit($p->keluhan, 150) }}</p>

                @if($p->foto_bukti)
                <div class="mt-3">
                    <img src="{{ asset('storage/'.$p->foto_bukti) }}" class="img-thumbnail" style="max-height: 150px; cursor: pointer;" onclick="window.open(this.src)">
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            Belum ada pengaduan yang Anda buat. Yuk, buat pengaduan pertama Anda!
        </div>
    </div>
    @endforelse
</div>
@endsection