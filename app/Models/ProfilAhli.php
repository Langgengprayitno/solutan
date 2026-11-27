<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilAhli extends Model
{
    protected $table = 'profil_ahli';

    protected $fillable = [
        'pengguna_id',
        'spesialisasi',
        'bidang_fokus',
        'deskripsi',
        'sedang_online',
        'rata_rata_balas_menit',
    ];

    protected function casts(): array
    {
        return [
            'sedang_online' => 'boolean',
        ];
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}