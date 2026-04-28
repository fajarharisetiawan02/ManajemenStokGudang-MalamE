@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

<h2 class="text-xl font-bold mb-4">Barang Masuk</h2>

<div class="bg-white p-6 rounded-xl shadow space-y-4">

    <select class="w-full border p-2 rounded">
        <option>Pilih Barang</option>
        <option>Oli Mesin</option>
        <option>Ban Mobil</option>
    </select>

    <input type="number" placeholder="Jumlah Masuk" class="w-full border p-2 rounded">

    <input type="date" class="w-full border p-2 rounded">

    <textarea placeholder="Keterangan" class="w-full border p-2 rounded"></textarea>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan (Dummy)
    </button>

</div>

@endsection
