<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ADMIN: lihat SEMUA user
    public function adminIndex()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // PETUGAS: lihat petugas & customer saja
    public function petugasIndex()
    {
        $users = User::whereIn('role', ['petugas', 'customer'])->latest()->get();
        return view('petugas.users.index', compact('users'));
    }

    // ADMIN: form tambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // ADMIN: simpan user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,petugas,customer',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Edit user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,petugas,customer',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }

    // PETUGAS: tambah customer saja
    public function petugasCreate()
    {
        return view('petugas.users.create');
    }

    public function petugasStore(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'customer', // <-- DIPAKSA JADI CUSTOMER, TIDAK BISA DIGANTI
        ]);

        return redirect()->route('petugas.users.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function petugasEdit(User $user)
    {
        // Blokir jika yang mau diedit bukan customer
        if ($user->role !== 'customer') {
            abort(403, 'Akses ditolak! Petugas hanya boleh mengedit Customer.');
        }
        return view('petugas.users.edit', compact('user'));
    }

    public function petugasUpdate(Request $request, User $user)
    {
        if ($user->role === 'admin') abort(403);

        $data = $request->validate([
            'name'  => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('petugas.users.index')->with('success', 'Customer berhasil diupdate!');
    }

    public function petugasDestroy(User $user)
    {
        // Blokir jika yang mau dihapus bukan customer
        if ($user->role !== 'customer') {
            abort(403, 'Akses ditolak! Petugas hanya boleh menghapus Customer.');
        }

        $user->delete();
        return back()->with('success', 'Customer berhasil dihapus!');
    }
}
