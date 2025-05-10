<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempat_magang_id',
        'tanggal',
        'keterangan',
    ];
}
