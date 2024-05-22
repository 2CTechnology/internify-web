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
        'created_at',
        'id_kelompok',
    ];
    
    public function prodi () {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
