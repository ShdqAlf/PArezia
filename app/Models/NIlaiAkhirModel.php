<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NIlaiAkhirModel extends Model
{
    use HasFactory;
    protected $table = "nilaiakhir";
    protected $fillable = [
        'nilaiqi',
        'rangking',
        'pelamar_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pelamar()
    {
        return $this->belongsTo(PelamarModel::class, 'pelamar_id');
    }
}
