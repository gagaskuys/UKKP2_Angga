@extends('layouts.app')
@section('title', 'Manajemen Customer')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👥 Manajemen Customer</h2>
        <a href="{{ route('petugas.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Customer
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-{{ $user->role == 'petugas' ? 'warning' : 'info' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('petugas.users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('petugas.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus customer ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection