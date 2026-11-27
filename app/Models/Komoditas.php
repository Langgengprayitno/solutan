<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Komoditas extends Model
{
    protected $table = 'komoditas';

    protected $fillable = ['nama', 'kode', 'satuan', 'aktif'];

    protected function casts(): array
    {
        return ['aktif' => 'boolean'];
    }

    public function riwayatHarga(): HasMany
    {
        return $this->hasMany(HargaKomoditas::class, 'komoditas_id');
    }

    public function hargaTerbaru(): HasOne
    {
        return $this->hasOne(HargaKomoditas::class, 'komoditas_id')->latestOfMany('waktu_pencatatan');
    }
}