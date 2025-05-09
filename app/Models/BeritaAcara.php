<?php

// app/Models/BeritaAcara.php
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
    ];

    // Relasi dengan model TempatMagang
    public function tempatMagang()
    {
        return $this->belongsTo(TempatMagang::class, 'tempat_magang_id');
    }
}
