<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarangGambar;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'kode',
        'nama_barang',
        'stok',
        'harga_beli',
        'harga_jual',
        'kategori_id',
        'supplier_id',
        'brand_id',
        'gambar',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function masuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function keluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function gambarBarang()
    {
        return $this->hasMany(BarangGambar::class, 'barang_id');
    }
}