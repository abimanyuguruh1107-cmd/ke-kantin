<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'id_siswa',
        'id_penjual',
        'status',
        'total_harga',
        'total',
        'metode_pembayaran',
    ];

    /*
     * Relasi ke Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'id_siswa');
    }

    /*
     * Relasi ke Penjual
     */
    public function penjual()
    {
        return $this->belongsTo(penjual::class, 'id_penjual');
    }

    /*
     * Relasi ke DetailTransaksi
     */
    public function detail()
    {
        return $this->hasMany(detail::class, 'id_transaksi');
    }
}
