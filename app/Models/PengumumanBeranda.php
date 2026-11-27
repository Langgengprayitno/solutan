<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanBeranda extends Model
{
    protected $table = 'pengumuman_beranda';

    protected $fillable = [
        'label_promo',
        'judul',
        'deskripsi',
        'teks_tombol',
        'tujuan_tombol',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return ['aktif' => 'boolean'];
    }
}