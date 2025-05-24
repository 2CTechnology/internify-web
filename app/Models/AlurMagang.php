<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlurMagang extends Model
{
    use HasFactory;

    protected $table = 'alur_magangs';
    protected $fillable = [
        'id_kelompok',
        'proposal',
        'status_proposal',
        'revisi_proposal',
        'alasan_proposal_ditolak',
        'tempat_magang',
        'nama_posisi',
        'id_tempat_magang',
        'surat_balasan',
        'status_surat_balasan',
        'created_at',
        'updated_at'
    ];

    public function kelompok() {
        return $this->belongsTo(Kelompok::class, 'id_kelompok');
    }

    public function tempatMagang () {
        return $this->belongsTo(TempatMagang::class, 'id_tempat_magang');
    }

    

}
