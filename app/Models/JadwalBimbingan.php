<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBimbingan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_bimbingans';

    protected $fillable = [
        'id_kelompok',
        'jadwal',
        'catatan',
    ];

    public function kelompok()
{
    return $this->belongsTo(Kelompok::class, 'id_kelompok');
}

}
