<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'nim',
        'nama',
        'id_prodi',
        'angkatan',
        'golongan',
        'id_kelompok',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telp',
        'email',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok');
    }

    public function laporanMagang()
    {
        return $this->hasMany(LaporanMagang::class, 'id_kelompok', 'id_kelompok');
    }
}