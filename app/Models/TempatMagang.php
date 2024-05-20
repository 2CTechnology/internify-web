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
        'updated_at'
    ];
}
