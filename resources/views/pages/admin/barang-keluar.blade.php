@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<h2 class="text-xl font-bold mb-4">Barang Keluar</h2>

<div class="bg-white p-6 rounded-xl shadow space-y-4">

    <select class="w-full border p-2 rounded">
        <option>Pilih Barang</option>
        <option>Oli Mesin</option>
        <option>Ban Mobil</option>
    </select>

    <input type="number" placeholder="Jumlah Keluar" class="w-full border p-2 rounded">

    <input type="date" class="w-full border p-2 rounded">

    <textarea placeholder="Keterangan" class="w-full border p-2 rounded"></textarea>

    <button class="bg-red-600 text-white px-4 py-2 rounded">
        Simpan (Dummy)
    </button>

</div>

@endsection
