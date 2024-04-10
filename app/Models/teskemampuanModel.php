<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesKemampuanModel extends Model
{
    use HasFactory;

    protected $table = 'teskemampuan';

    protected $fillable = [
        'pertanyaan',
        'foto',
        'file',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
