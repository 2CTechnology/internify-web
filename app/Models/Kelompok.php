<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompoks';

  protected $fillable = [
    'nama_kelompok',
    'id_users',
    'id_dospem',
    'created_at',
    'updated_at',
];

    // Relasi satu kelompok memiliki banyak anggota
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_kelompok');
    }

    // Relasi kelompok punya dosen pembimbing (user)
    public function dospem()
    {
        return $this->belongsTo(User::class, 'id_dospem');
    }

    // Relasi kelompok punya ketua (user)
    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
