@extends('layouts.app')
@section('title', 'Profil Saya')
@section('content')
    <h2 class="mb-4">👤 Edit Profil</h2>
    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
                </div>
            @endif
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Password Baru (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        @if($user->foto)
                            <img src="{{ asset('storage/'.$user->foto) }}" class="img-thumbnail mt-2" style="max-height:100px">
                        @endif
                    </div>
                </div>
                <button class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection