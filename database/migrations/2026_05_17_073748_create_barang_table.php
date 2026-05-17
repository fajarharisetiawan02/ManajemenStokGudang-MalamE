<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {

            $table->id();

            $table->string('no_part')->unique();

            $table->string('nama_barang');

            $table->unsignedBigInteger('kategori_id');

            $table->string('brand');

            $table->integer('stok')->default(0);

            $table->bigInteger('harga');

            $table->string('gambar')->nullable();

            $table->unsignedBigInteger('supplier_id');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};