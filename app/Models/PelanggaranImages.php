<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggaran_id',
        'image',
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }
}
