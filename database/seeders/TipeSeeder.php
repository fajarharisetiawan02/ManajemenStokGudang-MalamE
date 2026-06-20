<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipes')->truncate();

        $tipes = [
            // Toyota
            ['nama_tipe' => 'Agya 1.0'],
            ['nama_tipe' => 'Agya 1.2'],
            ['nama_tipe' => 'Avanza 1.3'],
            ['nama_tipe' => 'Avanza 1.5'],
            ['nama_tipe' => 'Calya 1.2'],
            ['nama_tipe' => 'Veloz 1.5'],
            ['nama_tipe' => 'Innova 2.0'],
            ['nama_tipe' => 'Innova Reborn 2.0'],
            ['nama_tipe' => 'Rush 1.5'],
            ['nama_tipe' => 'Raize 1.0 Turbo'],
            ['nama_tipe' => 'Raize 1.2'],

            // Daihatsu
            ['nama_tipe' => 'Ayla 1.0'],
            ['nama_tipe' => 'Ayla 1.2'],
            ['nama_tipe' => 'Xenia 1.0'],
            ['nama_tipe' => 'Xenia 1.3'],
            ['nama_tipe' => 'Sigra 1.0'],
            ['nama_tipe' => 'Sigra 1.2'],
            ['nama_tipe' => 'Terios 1.5'],
            ['nama_tipe' => 'Rocky 1.0 Turbo'],
            ['nama_tipe' => 'Rocky 1.2'],

            // Honda
            ['nama_tipe' => 'Brio 1.2'],
            ['nama_tipe' => 'Brio Satya 1.2'],
            ['nama_tipe' => 'Jazz 1.5'],
            ['nama_tipe' => 'CR-V 2.0'],
            ['nama_tipe' => 'HR-V 1.5'],
            ['nama_tipe' => 'BR-V 1.5'],

            // Suzuki
            ['nama_tipe' => 'Ertiga 1.5'],
            ['nama_tipe' => 'XL7 1.5'],
            ['nama_tipe' => 'Baleno 1.4'],
            ['nama_tipe' => 'Ignis 1.2'],

            // Mitsubishi
            ['nama_tipe' => 'Xpander 1.5'],
            ['nama_tipe' => 'Xpander Cross 1.5'],
            ['nama_tipe' => 'Pajero Sport 2.4 Diesel'],
            ['nama_tipe' => 'Pajero Sport 3.0 Bensin'],
        ];

        DB::table('tipes')->insert($tipes);
    }
}