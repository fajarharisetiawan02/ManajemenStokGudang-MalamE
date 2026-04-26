<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Kategori;
use App\Models\Supplier;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_part',
        'nama_barang',
        'kategori_id',
        'supplier_id',
        'stok',
        'harga'
    ];

    // 🔥 RELASI KE KATEGORI
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // 🔥 RELASI KE SUPPLIER
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}