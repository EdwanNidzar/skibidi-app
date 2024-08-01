<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SuratKerja extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nomor_surat_kerja',
        'assign_by',
        'assign_to',
    ];

    public static function generateNomorSuratKerja()
    {
        $lastSurat = self::orderBy('id', 'desc')->first();
        $lastNumber = $lastSurat ? intval(substr($lastSurat->nomor_surat_kerja, 3)) : 0;
        $newNumber = $lastNumber + 1;

        return 'SK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function assignBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}
