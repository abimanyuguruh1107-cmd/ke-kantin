<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjual extends Model
{
    use HasFactory;

    protected $table = 'penjual';

    protected $fillable = [
        'nama',
        'password',
        'no_hp',
        'no_kantin',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'last_seen' => 'datetime',
    ];

    public function isOnline($minutes = 1)
    {
        return $this->last_seen &&
               $this->last_seen->gt(now()->subMinutes($minutes));
    }

    // ✅ TAMBAHAN WAJIB untuk pendapatan
    public function transaksi()
    {
        return $this->hasMany(\App\Models\transaksi::class, 'id_penjual');
    }

    public function produk()
{
    return $this->hasMany(Produk::class, 'id_penjual');
}
}