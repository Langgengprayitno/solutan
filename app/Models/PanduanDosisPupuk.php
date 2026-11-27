<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanduanDosisPupuk extends Model
{
    protected $table = 'panduan_dosis_pupuk';

    protected $fillable = [
        'jenis_tanaman',
        'kode_tanaman',
        'dosis_organik_kg_ha',
        'dosis_urea_kg_ha',
        'dosis_npk_kg_ha',
        'tahap_pemberian',
        'catatan_ahli',
    ];

    protected function casts(): array
    {
        return [
            'tahap_pemberian' => 'array',
        ];
    }
}