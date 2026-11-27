<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'petani_id',
        'ahli_id',
        'jenis_tanaman',
        'ringkasan_gejala',
        'status',
    ];

    public function petani(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'petani_id');
    }

    public function ahli(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'ahli_id');
    }

    public function pesan(): HasMany
    {
        return $this->hasMany(PesanKonsultasi::class, 'konsultasi_id');
    }
}