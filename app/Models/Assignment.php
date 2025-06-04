<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ploting_dosen',
        'id_kelompok',
        'id_tempat_magang',
        'tahun',
        'keterangan',
    ];

    // Relasi ke dosen
    public function plotingDosen()
    {
        return $this->belongsTo(PlotingDosen::class, 'id_ploting_dosen');
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok');
    }

    public function tempatMagang()
    {
        return $this->belongsTo(TempatMagang::class, 'id_tempat_magang');
    }
}