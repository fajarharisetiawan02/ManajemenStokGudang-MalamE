<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // 🔥 WAJIB (karena nama tabel bukan plural)
    protected $table = 'supplier';

    // 🔥 FIELD YANG BOLEH DIISI
    protected $fillable = [
        'nama_supplier',
        'telepon'
    ];

    // 🔥 RELASI KE BARANG (opsional tapi bagus)
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}