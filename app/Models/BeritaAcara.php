<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempat_magang_id',
        'jadwal',
        'prodi',
        'jurusan',
        'alamat',
        'keterangan',
        'catatan',
        'kelompok_id',  // tambahkan ini
    ];

    // Relasi dengan model TempatMagang
    public function tempatMagang()
    {
        return $this->belongsTo(TempatMagang::class, 'tempat_magang_id');
    }

    // Relasi dengan model Kelompok
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
