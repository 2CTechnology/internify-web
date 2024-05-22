<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTemplate extends Model
{
    use HasFactory;
    protected $table = 'file_templates';
    protected $fillable = [
        'nama_file',
        'file',
        'created_at',
        'updated_at'
    ];
}
