<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_pelanggaran'
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}
