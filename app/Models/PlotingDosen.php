<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotingDosen extends Model
{
    use HasFactory;
    protected $table = 'ploting_dosens';
    protected $fillable = [
        'id_dosen',
        'kota',
        'tahun',
        'status',
        'jumlah_kelompok',
        'created_at',
        'updated_at'
    ];

    public function dosen() {
        return $this->belongsTo(User::class, 'id_dosen');
    }


public function tempat()
{
    return $this->belongsTo(TempatMagang::class, 'id_tempat');
}

public function prodi()
{
    return $this->belongsTo(Prodi::class, 'id_prodi');
}

}
