<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'siswa_id',
        'produk_id',
        'qty',
        'harga'
    ];

    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id');
    }


    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }
}

