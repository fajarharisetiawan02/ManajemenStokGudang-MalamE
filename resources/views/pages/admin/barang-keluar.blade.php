@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<div class="w-full space-y-4">

    {{-- FORM --}}
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Barang Keluar</h3>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data barang keluar di bawah ini.</p>
        </div>

        <div class="p-5">
            <form action="{{ route('admin.barang-keluar.store') }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-gray-700">Tanggal Keluar</label>
                        <input type="date" name="tanggal"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Barang</label>
                        <select name="barang_id"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl">
                            <option value="">Pilih Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">
                                    {{ $barang->kode }} - {{ $barang->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Jumlah Keluar</label>
                        <input type="number" name="jumlah"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Harga Jual</label>
                        <input type="number" name="harga_jual"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl">
                    </div>

                </div>

                <div class="mt-5 pt-5 border-t">
                    <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-xl">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-sm">

                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Kode</th>
                        <th class="p-3">Nama Barang</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Harga Jual</th>
                        <th class="p-3">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barangKeluars as $i => $item)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3 text-center">{{ $i + 1 }}</td>

                            <td class="p-3">
                                {{ $item->tanggal }}
                            </td>

                            <td class="p-3 font-mono">
                                {{ $item->barang?->kode ?? '-' }}
                            </td>

                            <td class="p-3 font-semibold">
                                {{ $item->barang?->nama ?? '-' }}
                            </td>

                            <td class="p-3 text-center">
                                {{ $item->jumlah }}
                            </td>

                            <td class="p-3 text-right text-green-600 font-medium">
                                Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </td>

                            <td class="p-3 text-right font-semibold">
                                Rp {{ number_format($item->jumlah * $item->harga_jual, 0, ',', '.') }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-500">
                                Belum ada data barang keluar
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="p-3 text-sm text-gray-600">
            Total data: {{ $barangKeluars->count() }}
        </div>

    </div>

</div>

@endsection