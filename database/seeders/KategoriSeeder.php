<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->truncate();

        $kategoris = [
            ['nama_kategori' => 'Mesin'],
            ['nama_kategori' => 'Sistem Rem'],
            ['nama_kategori' => 'Sistem Kemudi'],
            ['nama_kategori' => 'Suspensi & Kaki-Kaki'],
            ['nama_kategori' => 'Sistem Pendingin'],
            ['nama_kategori' => 'Sistem Bahan Bakar'],
            ['nama_kategori' => 'Sistem Kelistrikan'],
            ['nama_kategori' => 'Transmisi & Kopling'],
            ['nama_kategori' => 'Body & Eksterior'],
            ['nama_kategori' => 'Interior'],
            ['nama_kategori' => 'Filter'],
            ['nama_kategori' => 'Oli & Cairan'],
            ['nama_kategori' => 'Ban & Velg'],
            ['nama_kategori' => 'Aksesori'],
        ];

        DB::table('kategori')->insert($kategoris);
    }
}