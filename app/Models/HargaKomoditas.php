<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HargaKomoditas extends Model
{
    protected $table = 'harga_komoditas';

    protected $fillable = [
        'komoditas_id',
        'nama_pasar',
        'harga_per_kg',
        'harga_sebelumnya',
        'persen_perubahan',
        'arah_harga',
        'waktu_pencatatan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_pencatatan' => 'datetime',
            'persen_perubahan' => 'decimal:2',
        ];
    }

    public function komoditas(): BelongsTo
    {
        return $this->belongsTo(Komoditas::class, 'komoditas_id');
    }
}