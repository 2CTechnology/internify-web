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
        'tempat_magang',
        'surat_balasan',
        'status',
        'created_at',
        'updated_at'
    ];

    public function kelompok() {
        return $this->belongsTo(Kelompok::class, 'id_kelompok');
    }
}
