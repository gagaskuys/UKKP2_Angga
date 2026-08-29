<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('profil.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'    => 'required|min:3',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'alamat'  => 'nullable',
            'no_hp'   => 'nullable',
            'foto'    => 'nullable|image|max:2048',
            'password'=> 'nullable|min:6|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) Storage::disk('public')->delete($user->foto);
            $data['foto'] = $request->file('foto')->store('profil', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return back()->with('success', 'Profil berhasil diupdate!');
    }
}