<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'foto',
        'parent_id'
    ];

    // induk
    public function parent()
    {
        return $this->belongsTo(Kategori::class, 'parent_id');
    }

    // anak (sub kategori)
    public function children()
    {
        return $this->hasMany(Kategori::class, 'parent_id');
    }

    // barang di kategori ini
public function barang()
{
    return $this->hasMany(Barang::class, 'kategori_id', 'id');
}
}