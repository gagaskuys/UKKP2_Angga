<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role', 'foto', 'alamat', 'no_hp'];
    protected $hidden = ['password', 'remember_token'];

    // Relasi: satu user punya banyak pengaduan
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }

    // Helper cek role
    public function isAdmin()   { return $this->role === 'admin'; }
    public function isPetugas() { return $this->role === 'petugas'; }
    public function isCustomer(){ return $this->role === 'customer'; }
}