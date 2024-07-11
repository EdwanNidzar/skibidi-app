<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPelanggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggaran_id',
        'address',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'latitude',
        'longitude',
        'assign_by',
        'status',
        'note',
        'verif_by',
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verif_by');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

}
