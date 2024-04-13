<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalisasiModel extends Model
{
    use HasFactory;

    protected $table = "normalisasi";
    protected $fillable = [
        'hasil_normalisasi',
        'penilaian_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penilaian()
    {
        return $this->belongsTo(PenilaianModel::class);
    }
}
