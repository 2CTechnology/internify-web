<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    // Biasanya tidak perlu memasukkan 'created_at' ke fillable karena Laravel otomatis mengelolanya.
    // Namun jika memang ingin mengisi secara manual, boleh dimasukkan.
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
        'created_at',   // Optional, bisa dihapus jika tidak perlu mass assignment
        'updated_at',   // Jika ingin memasukkan juga updated_at, tambahkan di sini
    ];

    // Relasi ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

// <<<<<<< main
//     // Relasi ke Kelompok
//     public function kelompok()
//     {
//         return $this->belongsTo(Kelompok::class, 'id_kelompok');
//     }
// =======
//     public function laporanMagang()
//     {
//         return $this->hasMany(LaporanMagang::class, 'id_kelompok');
//     }

// >>>>>>> feat/laporan-magang
}
