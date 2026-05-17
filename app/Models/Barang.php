<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'no_part',
        'nama_barang',
        'kategori_id',
        'brand',
        'stok',
        'harga',
        'gambar',
        'supplier_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}