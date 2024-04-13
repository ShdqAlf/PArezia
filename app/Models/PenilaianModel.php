<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianModel extends Model
{
    use HasFactory;
    protected $table = 'penilaian';

    protected $fillable = [
        'nilai',
        'pelamar_id',
        'kriteria_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pelamar()
    {
        return $this->belongsTo(PelamarModel::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class);
    }
    public function normalisasi()
    {
        return $this->hasOne(NormalisasiModel::class);
    }
}
