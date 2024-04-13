<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PenilaianModel extends Model
{
    use HasFactory;
    protected $table = 'penilaian';

    protected $fillable = [
        'nilai',
        'teskemampuan_id',
        'kriteria_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function teskemampuan()
    {
        return $this->belongsTo(TesModel::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class);
    }
    public function normalisasi()
    {
        return $this->hasOne(NormalisasiModel::class);
    }
    public function pelamar()
    {
        return $this->hasOne(PelamarModel::class, 'pelamar_id');
    }
}
