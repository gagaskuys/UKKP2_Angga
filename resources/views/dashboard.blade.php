@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <h2 class="mb-4">📊 Dashboard</h2>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card card-stat p-4 bg-primary text-white">
                <h6>Total Pengaduan</h6>
                <h2>{{ $total_pengaduan }}</h2>
                <i class="bi bi-chat-dots" style="font-size:2rem;opacity:0.5"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat p-4 bg-warning text-white">
                <h6>Pengaduan Belum Ditangani</h6>
                <h2>{{ $pengaduan_belum }}</h2>
                <i class="bi bi-exclamation-circle" style="font-size:2rem;opacity:0.5"></i>
            </div>
        </div>
        @if(auth()->user()->isAdmin())
            <div class="col-md-4">
                <div class="card card-stat p-4 bg-success text-white">
                    <h6>Total User</h6>
                    <h2>{{ $total_user }}</h2>
                    <i class="bi bi-people" style="font-size:2rem;opacity:0.5"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-stat p-4 bg-info text-white">
                    <h6>Total Kategori</h6>
                    <h2>{{ $total_kategori }}</h2>
                    <i class="bi bi-tags" style="font-size:2rem;opacity:0.5"></i>
                </div>
            </div>
        @endif
    </div>
@endsection