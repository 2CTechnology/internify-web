<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = 'kelompoks';
    protected $fillable = [
        'nama_kelompok',
        'id_users',
        'id_dospem',
        'created_at',
        'updated_at'
    ];
}
