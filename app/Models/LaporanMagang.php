<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMagang extends Model
{
    use HasFactory;

    protected $table = 'laporan_magangs';

    protected $fillable = [
        'id_kelompok',
        'laporan',
        'catatan',
        'status_laporan',
    ];

    public function kelompok()
{
    return $this->belongsTo(Kelompok::class, 'id_kelompok');
}

}
