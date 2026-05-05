@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

<!-- ================= TABLE ================= -->
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- SEARCH -->
    <div class="flex flex-wrap gap-2 mb-4">
        <input type="text" placeholder="Cari kode atau nama barang..."
            class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

        <select class="px-3 py-2 border border-gray-300 rounded-lg">
            <option>Semua Supplier</option>
            <option>PT Denso</option>
        </select>

        <button class="bg-green-600 text-white px-4 rounded-lg">
            Export
        </button>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm">

            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Kode</th>
                    <th class="px-4 py-3 text-left">Nama Barang</th>
                    <th class="px-4 py-3 text-center">Jumlah</th>
                    <th class="px-4 py-3 text-left">Supplier</th>

                </tr>
            </thead>

            <tbody>

                @if(empty(session('barang_masuk')))
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-400">
                        Belum ada data barang masuk
                    </td>
                </tr>
                @endif

                @foreach(session('barang_masuk', []) as $i => $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-3 text-center">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">{{ $item['tanggal'] }}</td>
                    <td class="px-4 py-3">{{ $item['kode'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $item['nama'] }}</td>
                    <td class="px-4 py-3 text-center text-blue-600 font-semibold">{{ $item['jumlah'] }}</td>
                    <td class="px-4 py-3">{{ $item['supplier'] }}</td>

                </tr>
                @endforeach

            </tbody>

        </table>
    </div>

</div>

@endsection