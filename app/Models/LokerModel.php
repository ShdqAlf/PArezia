<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'keterangan',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
