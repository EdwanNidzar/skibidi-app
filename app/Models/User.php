<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
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

    public function suratKerjaAssignBy()
    {
        return $this->hasMany(SuratKerja::class, 'assign_by');
    }

    public function suratKerjaAssignTo()
    {
        return $this->hasMany(SuratKerja::class, 'assign_to');
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'pelapor_id');
    }

    public function laporanPelanggaranAssignBy()
    {
        return $this->hasMany(LaporanPelanggaran::class, 'assign_by');
    }

    public function laporanPelanggaranVerifiedBy()
    {
        return $this->hasMany(LaporanPelanggaran::class, 'verif_by');
    }
}
