<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiRead extends Model
{
    protected $table = 'notifikasi_reads';

    protected $fillable = ['user_id', 'barang_id', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}