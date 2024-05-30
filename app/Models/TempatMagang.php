<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatMagang extends Model
{
    use HasFactory;
    protected $table = 'tempat_magangs';
    protected $fillable = [
        'nama_tempat',
        'created_at',
        'updated_at',
        'deskripsi_pekerjaan',
        'deskripsi_perusahaan',
        'website',
        'industri',
        'employee_size',
        'head_office',
        'since',
        'specialization',
        'kriteria',
        'posisi',
        'alamat',
    ];
}
