<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TesKemampuanModel extends Model
{
    use HasFactory;

    protected $table = 'teskemampuan';

    protected $fillable = [
        'keterangan',
        'file_download',
        'file_upload',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function loker(): HasOne
    {
        return $this->hasOne(LokerModel::class);
    }
}
