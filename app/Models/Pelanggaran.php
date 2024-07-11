<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'parpol_id',
        'jenis_pelanggaran_id',
        'status_peserta_pemilu',
        'nama_bacaleg',
        'dapil',
        'tanggal_input',
        'keterangan',
        'surat_kerja_id',
        'pelapor_id',
    ];

    public function parpol()
    {
        return $this->belongsTo(Parpol::class);
    }

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }

    public function suratKerja()
    {
        return $this->belongsTo(SuratKerja::class);
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggaranImages()
    {
        return $this->hasMany(PelanggaranImages::class);
    }

    public function laporanPelanggaran()
    {
        return $this->hasOne(LaporanPelanggaran::class);
    }

}
