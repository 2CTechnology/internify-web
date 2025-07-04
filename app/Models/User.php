<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'angkatan',
        'golongan',
        'prodi_id',
        'no_identitas',
        'created_at',
        'updated_at',
        'role',
        'is_accepted',
        'foto',
        'no_telp',
        'tanggal_lahir',
        'jenis_kelamin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAccepted(): bool
{
    return $this->is_accepted == 1;
}

public function isPending(): bool
{
    return is_null($this->is_accepted) || $this->is_accepted == 0;
}

public function isRejected(): bool
{
    return $this->is_accepted == 2;
}


    public function kelompok () {
        return $this->hasOne(Kelompok::class, 'id_users');
    }

    public function anggota () {
        $kelompok = new Kelompok();
        return $kelompok->anggota();
    }

    public function prodi () {
        return $this->belongsTo(Prodi::class);
    }
}
