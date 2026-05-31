<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'kode',
        'nama',
        'stok',
        'harga_beli',
        'harga_jual',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function masuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function keluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}