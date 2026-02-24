<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id_penjual',
        'kategori_id',
        'harga',
        'stok',
    ];

    // Relasi ke Penjual
    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }
    

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detail_transaksi()
    {
        return $this->hasMany(detail::class, 'id_produk');
    }
}
