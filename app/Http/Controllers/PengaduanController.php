<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // CUSTOMER: buat pengaduan
public function create()
{
    $kategori = \App\Models\Kategori::all(); // Ambil semua kategori dari database
    return view('customer.pengaduan.create', compact('kategori'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'judul'      => 'required|min:5',
        'kategori_id'=> 'required|exists:kategori,id', // Validasi kategori
        'keluhan'    => 'required|min:10',
        'foto_bukti' => 'nullable|image|max:2048',
    ]);

    $data['user_id'] = auth()->id();

    if ($request->hasFile('foto_bukti')) {
        $data['foto_bukti'] = $request->file('foto_bukti')->store('pengaduan', 'public');
    }

    Pengaduan::create($data);
    return redirect()->route('customer.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
}

    // CUSTOMER: lihat pengaduan sendiri
    public function customerIndex()
    {
        $pengaduan = Pengaduan::where('user_id', auth()->id())->latest()->get();
        return view('customer.pengaduan.index', compact('pengaduan'));
    }

    // ADMIN & PETUGAS: lihat semua pengaduan
    public function adminIndex()
    {
        $pengaduan = Pengaduan::with('user')->latest()->get();
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function petugasIndex()
    {
        $pengaduan = Pengaduan::with('user')->latest()->get();
        return view('petugas.pengaduan.index', compact('pengaduan'));
    }

    // ADMIN: edit & hapus pengaduan
    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $data = $request->validate([
            'judul'   => 'required|min:5',
            'keluhan' => 'required|min:10',
            'status'  => 'required|in:belum,sedang,sudah',
        ]);

        $pengaduan->update($data);
        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil diupdate!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->foto_bukti) Storage::disk('public')->delete($pengaduan->foto_bukti);
        $pengaduan->delete();
        return back()->with('success', 'Pengaduan berhasil dihapus!');
    }

    // PETUGAS: ubah status saja
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate(['status' => 'required|in:belum,sedang,sudah']);
        $pengaduan->update(['status' => $request->status]);
        return back()->with('success', 'Status pengaduan berhasil diubah!');
    }
}