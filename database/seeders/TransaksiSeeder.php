<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // ID Barang yang ada: 12-29
        $barangIds   = range(12, 29);
        // ID Supplier yang ada: 2, 3, 4
        $supplierIds = [2, 3, 4];

        $masuk  = [];
        $keluar = [];

        // Generate data 11 bulan ke belakang (Jul 2025 - Mei 2026)
        // Bulan Jun 2026 sudah ada data real, skip
        for ($i = 11; $i >= 1; $i--) {
            $month = Carbon::today()->subMonths($i);

            // Buat 3-6 transaksi masuk per bulan
            $jmlMasuk = rand(3, 6);
            for ($j = 0; $j < $jmlMasuk; $j++) {
                $barangId   = $barangIds[array_rand($barangIds)];
                $supplierId = $supplierIds[array_rand($supplierIds)];
                $jumlah     = rand(5, 30);
                $hargaBeli  = rand(50000, 500000);
                $tanggal    = $month->copy()->addDays(rand(1, 28))->format('Y-m-d');

                $masuk[] = [
                    'barang_id'   => $barangId,
                    'supplier_id' => $supplierId,
                    'tanggal'     => $tanggal,
                    'jumlah'      => $jumlah,
                    'harga_beli'  => $hargaBeli,
                    'total'       => $jumlah * $hargaBeli,
                    'created_at'  => $tanggal,
                    'updated_at'  => $tanggal,
                ];
            }

            // Buat 2-4 transaksi keluar per bulan
            $jmlKeluar = rand(2, 4);
            for ($j = 0; $j < $jmlKeluar; $j++) {
                $barangId  = $barangIds[array_rand($barangIds)];
                $jumlah    = rand(2, 15);
                $hargaJual = rand(80000, 700000);
                $tanggal   = $month->copy()->addDays(rand(1, 28))->format('Y-m-d');

                $keluar[] = [
                    'barang_id'  => $barangId,
                    'tanggal'    => $tanggal,
                    'jumlah'     => $jumlah,
                    'harga_jual' => $hargaJual,
                    'total'      => $jumlah * $hargaJual,
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ];
            }
        }

        // Insert semua data
        DB::table('barang_masuks')->insert($masuk);
        DB::table('barang_keluars')->insert($keluar);

        $this->command->info('✅ TransaksiSeeder: ' . count($masuk) . ' barang masuk, ' . count($keluar) . ' barang keluar berhasil di-seed!');
    }
}