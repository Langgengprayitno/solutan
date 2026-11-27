<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'persen_diskon',
        'stok',
        'produk_subsidi',
        'bisa_cod',
        'foto_produk',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'produk_subsidi' => 'boolean',
            'bisa_cod' => 'boolean',
            'aktif' => 'boolean',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function hargaSetelahDiskon(): int
    {
        if ($this->persen_diskon <= 0) {
            return $this->harga;
        }

        return (int) round($this->harga * (100 - $this->persen_diskon) / 100);
    }
}