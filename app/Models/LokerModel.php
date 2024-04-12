<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LokerModel extends Model
{
    use HasFactory;
    protected $table = 'lowongan';
    protected $fillable = [
        'judul',
        'posisi',
        'minimal_pendidikan',
        'minimal_pengalaman',
        'usia_maks',
        'tanggal_berakhir',
        'keterangan',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function teskemampuan() : HasOne{
        return $this->hasOne(TesKemampuanModel::class, 'lowongan_id');
    }
}
