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

<<<<<<< HEAD
    public function teskemampuan() : HasOne{
=======
    public function teskemampuan(): HasOne
    {
>>>>>>> 591a5c4449b18c818bcfa03d360d49c350cbd965
        return $this->hasOne(TesModel::class, 'lowongan_id');
    }
}
