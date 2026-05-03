@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold">Dashboard Manager</h1>
    <p class="text-gray-500 text-sm">Mode hanya lihat (read only)</p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Total Barang</p>
        <h2 class="text-2xl font-bold">{{ $totalBarang }}</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Barang Masuk</p>
        <h2 class="text-2xl font-bold text-green-600">{{ $barangMasuk }}</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Barang Keluar</p>
        <h2 class="text-2xl font-bold text-red-600">{{ $barangKeluar }}</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Supplier</p>
        <h2 class="text-2xl font-bold">{{ $supplier }}</h2>
    </div>

</div>

<!-- TRANSAKSI -->
<div class="bg-white rounded-xl shadow p-5 mb-6">

    <h3 class="font-bold mb-4">Transaksi Terbaru</h3>

    <table class="w-full text-sm">
        <thead class="text-left text-gray-500 border-b">
            <tr>
                <th class="py-2">Tanggal</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @foreach($transaksi as $t)
            <tr class="border-b">
                <td class="py-2">{{ $t->tanggal }}</td>
                <td>{{ $t->barang }}</td>
                <td>{{ $t->qty }}</td>
                <td>
                    @if($t->status == 'Masuk')
                        <span class="text-green-600 font-semibold">Masuk</span>
                    @else
                        <span class="text-red-600 font-semibold">Keluar</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

<!-- STOK MENIPIS -->
<div class="bg-white rounded-xl shadow p-5">

    <h3 class="font-bold mb-4">Stok Menipis</h3>

    <div class="grid md:grid-cols-3 gap-3">

        @foreach($stokMenipis as $s)
        <div class="border rounded-lg p-4 bg-red-50">
            <p class="font-semibold">{{ $s->nama }}</p>
            <p class="text-red-600 text-sm">Sisa: {{ $s->stok }}</p>
        </div>
        @endforeach

    </div>

</div>

@endsection