<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';

    protected $fillable = [
        'nama_kriteria',
        'kode_bobot',
        'nilai_bobot',
        'jenis_kriteria'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penilaian()
    {
        return $this->hasOne(PenilaianModel::class);
    }
}
