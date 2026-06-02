<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangGambar extends Model
{
    protected $fillable = [
        'barang_id',
        'gambar'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}