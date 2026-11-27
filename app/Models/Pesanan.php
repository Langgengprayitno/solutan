<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'kode_pesanan',
        'pengguna_id',
        'metode_bayar',
        'ongkir',
        'total_bayar',
        'alamat_kirim',
        'catatan',
        'status',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}