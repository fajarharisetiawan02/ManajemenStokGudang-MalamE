@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

<div class="w-full space-y-4">

    {{-- FORM --}}
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Barang Masuk</h3>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data barang masuk di bawah ini.</p>
        </div>

        <div class="p-5">
            <form action="{{ route('admin.barang-masuk.store') }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" name="tanggal"
                            class="w-full mt-1 px-3 py-2.5 border rounded-xl border-gray-300">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Barang</label>
                        <select name="barang_id"
                            class="w-full mt-1 px-3 py-2.5 border rounded-xl border-gray-300">
                            <option value="">Pilih Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">
                                    {{ $barang->kode }} - {{ $barang->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Jumlah Masuk</label>
                        <input type="number" name="jumlah"
                            class="w-full mt-1 px-3 py-2.5 border rounded-xl border-gray-300">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Harga Beli</label>
                        <input type="number" name="harga_beli"
                            class="w-full mt-1 px-3 py-2.5 border rounded-xl border-gray-300">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id"
                            class="w-full mt-1 px-3 py-2.5 border rounded-xl border-gray-300">
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
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
    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Kode</th>
                        <th class="p-3">Nama Barang</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Harga Beli</th>
                        <th class="p-3">Supplier</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barangMasuks as $i => $item)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3 text-center">{{ $i + 1 }}</td>

                        <td class="p-3">
                            {{ $item->tanggal }}
                        </td>

                        <td class="p-3 font-mono">
                            {{ $item->barang?->kode ?? '-' }}
                        </td>

                        <td class="p-3 font-semibold text-gray-800">
                            {{ $item->barang?->nama ?? '-' }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $item->jumlah }}
                        </td>

                        <td class="p-3 text-green-600 font-medium">
                            Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </td>

                        <td class="p-3">
                            {{ $item->supplier?->nama_supplier ?? '-' }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-500">
                            Tidak ada data barang masuk
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="p-3 text-sm text-gray-600">
            Total data: {{ $barangMasuks->count() }}
        </div>

    </div>

</div>

@endsection