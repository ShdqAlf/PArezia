<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Syarat extends Model
{
    use HasFactory;
    protected $table = 'syarat';

    protected $fillable = [
        'cv',
        'dokumen_lainnya',
        'pelamar_id',
        'lowongan_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(LokerModel::class, 'lowongan_id');
    }

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(PelamarModel::class, 'tes_id');
    }
}
