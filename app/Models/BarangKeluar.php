<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluars';
    
    protected $fillable = [
    'barang_id',
    'tanggal',
    'jumlah',
    'harga_jual',
    'total',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
