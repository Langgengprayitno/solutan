<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'no_hp',
        'kata_sandi',
        'peran',
        'desa',
        'kecamatan',
        'kabupaten',
        'alamat_pengiriman',
        'foto_profil',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'kata_sandi' => 'hashed',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'kata_sandi';
    }

    public function getAuthPassword(): string
    {
        return $this->kata_sandi;
    }

    public function profilAhli(): HasOne
    {
        return $this->hasOne(ProfilAhli::class, 'pengguna_id');
    }

    public function konsultasiSebagaiPetani(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'petani_id');
    }

    public function konsultasiSebagaiAhli(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'ahli_id');
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'pengguna_id');
    }
}