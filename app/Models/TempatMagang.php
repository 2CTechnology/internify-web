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
        'daerah',
        'created_at',
        'updated_at',
        'deskripsi_pekerjaan',
        'fasilitas',
        'deskripsi_perusahaan',
        'website',
        'industri',
        'employee_size',
        'head_office',
        'type',
        'since',
        'specialization',
    ];
}
