@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('icon')
<i class="fas fa-arrow-up text-blue-600"></i>
@endsection

@section('content')

<!-- ❌ FORM DIHAPUS (READ ONLY) -->

<!-- ================= TABLE ================= -->
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- SEARCH -->
    <div class="flex flex-wrap gap-2 mb-4">
        <input type="text" placeholder="Cari kode atau nama barang..."
            class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

        <!-- EXPORT tetap -->
        <button class="bg-green-600 text-white px-4 rounded-lg">
            Export
        </button>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm">

            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Kode</th>
                    <th class="px-4 py-3 text-left">Nama Barang</th>
                    <th class="px-4 py-3 text-center">Jumlah</th>
                    <th class="px-4 py-3 text-left">Tujuan</th>
                    <!-- ❌ AKSI DIHAPUS -->
                </tr>
            </thead>

            <tbody>
                @if(empty($data))
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-400">
                        Belum ada data barang keluar
                    </td>
                </tr>
                @else

                @foreach($data as $i => $item)
                <tr class="border-b">

                    <td class="px-4 py-3 text-center">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">{{ $item['tanggal'] }}</td>
                    <td class="px-4 py-3">{{ $item['kode'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $item['nama'] }}</td>
                    <td class="px-4 py-3 text-center text-red-600 font-semibold">{{ $item['jumlah'] }}</td>
                    <td class="px-4 py-3">{{ $item['tujuan'] }}</td>

                    <!-- ❌ AKSI DIHAPUS -->

                </tr>
                @endforeach

                @endif
            </tbody>

        </table>
    </div>

</div>

@endsection