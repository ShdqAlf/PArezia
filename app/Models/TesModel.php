<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TesModel extends Model
{
    use HasFactory;
    protected $table = 'teskemampuan';

    protected $fillable = [
        'keterangan',
        'file_download',
        'lowongan_id',
        'syarat_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function syarat(): BelongsTo
    {
        return $this->belongsTo(Syarat::class, 'syarat_id');
    }
    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(LokerModel::class, 'lowongan_id');
    }

    public function pelamar(): HasOne
    {
        return $this->hasOne(PelamarModel::class, 'tes_id');
    }
}