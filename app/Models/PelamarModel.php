<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'user_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
