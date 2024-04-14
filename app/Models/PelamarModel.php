<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PelamarModel extends Model
{
    use HasFactory;
    protected $table = 'pelamar';
    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'file_upload',
        'user_id',
        'lowongan_id',
        'tes_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(LokerModel::class);
    }
    public function teskemampuan(): BelongsTo
    {
        return $this->belongsTo(TesModel::class, 'tes_id');
    }
    public function penilaian(): HasOne
    {
        return $this->hasOne(PenilaianModel::class, 'pelamar_id');
    }
}
