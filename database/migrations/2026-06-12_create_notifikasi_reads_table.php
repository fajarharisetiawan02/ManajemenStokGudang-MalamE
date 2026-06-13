<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->timestamp('read_at');
            $table->timestamps();

            $table->unique(['user_id', 'barang_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi_reads');
    }
};