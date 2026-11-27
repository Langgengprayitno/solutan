<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnsiklopediPenyakit extends Model
{
    protected $table = 'ensiklopedi_penyakit';

    protected $fillable = [
        'jenis_tanaman',
        'nama_penyakit',
        'slug',
        'ringkasan',
        'gejala',
        'langkah_awal',
        'foto_penyakit',
    ];

    protected function casts(): array
    {
        return [
            'langkah_awal' => 'array',
        ];
    }
}