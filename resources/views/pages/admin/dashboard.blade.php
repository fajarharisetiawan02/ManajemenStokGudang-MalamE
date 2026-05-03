@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- HERO -->
<div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-3xl p-8 shadow-xl mb-10 flex items-center justify-between relative overflow-hidden">

    <div class="text-white max-w-lg z-20">
        <h1 class="text-4xl font-bold mb-2">Halo 👋</h1>

        <h2 class="text-2xl font-semibold">
            {{ Auth::user()->name ?? 'Admin GudangPro' }}
        </h2>

        <p class="mt-3 text-white/90">
            Monitoring stok, transaksi masuk & keluar secara real-time.
        </p>
    </div>

    <img src="{{ asset('images/LogoDashboard.png') }}"
        class="hidden md:block absolute right-6 bottom-0 w-72 opacity-90">
</div>

<!-- STAT -->
<div class="grid md:grid-cols-4 gap-6 mb-10">

    @php
        $totalBarang = $totalBarang ?? 0;
        $barangMasuk = $barangMasuk ?? 0;
        $barangKeluar = $barangKeluar ?? 0;
        $supplier = $supplier ?? 0;
    @endphp

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-500">Total Barang</p>
        <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ number_format($totalBarang) }}</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Barang Masuk</p>
        <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $barangMasuk }}</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Barang Keluar</p>
        <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $barangKeluar }}</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Supplier</p>
        <h3 class="text-3xl font-bold text-purple-600 mt-2">{{ $supplier }}</h3>
    </div>

</div>

<!-- CHART -->
<div class="grid lg:grid-cols-2 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl shadow h-[400px]">
        <h3 class="font-bold mb-4">Pergerakan Stok</h3>
        <canvas id="stokChart"></canvas>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="font-bold mb-4">Distribusi Supplier</h3>
        <canvas id="donutChart"></canvas>
    </div>

</div>

<!-- TABLE -->
<div class="grid lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">

        <h3 class="font-bold mb-4">Transaksi Terbaru</h3>

        <table class="w-full text-sm">
            <thead class="text-gray-400">
                <tr>
                    <th class="text-left py-2">Tanggal</th>
                    <th class="text-left">Barang</th>
                    <th>Qty</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($transaksi ?? [] as $t)
                <tr class="border-t">
                    <td class="py-2">{{ $t->tanggal }}</td>
                    <td>{{ $t->barang }}</td>
                    <td>{{ $t->qty }}</td>
                    <td>
                        <span class="{{ $t->status == 'Masuk' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $t->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-400">
                        Tidak ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div class="bg-white p-6 rounded-2xl shadow">

        <h3 class="font-bold mb-4 text-red-500">⚠ Stok Menipis</h3>

        @forelse($stokMenipis ?? [] as $s)
        <div class="p-3 bg-red-50 text-red-600 rounded-xl mb-2">
            {{ $s->nama }} - {{ $s->stok }} pcs
        </div>
        @empty
        <p class="text-gray-400">Aman semua</p>
        @endforelse

    </div>

</div>

@endsection