@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

<div class="space-y-5">

    {{-- FORM --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-semibold text-slate-800">
                Form Barang Masuk
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Lengkapi data barang masuk di bawah ini.
            </p>
        </div>

        <div class="p-5">

            <form action="{{ route('admin.barang-masuk.store') }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Tanggal Masuk
                        </label>

                        <input type="date" name="tanggal" required
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Barang
                        </label>

                        <select name="barang_id" required
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            <option value="">
                                Pilih Barang
                            </option>

                            @foreach($barangs as $barang)

                            <option value="{{ $barang->id }}">
                                {{ $barang->kode }} - {{ $barang->nama_barang }}
                            </option>

                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Jumlah Masuk
                        </label>

                        <input type="number" name="jumlah" required min="1"
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Harga Beli
                        </label>

                        <input type="number" name="harga_beli" required min="0"
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">
                            Supplier
                        </label>

                        <select name="supplier_id" required
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            <option value="">
                                Pilih Supplier
                            </option>

                            @foreach($suppliers as $supplier)

                            <option value="{{ $supplier->id }}">
                                {{ $supplier->nama_supplier }}
                            </option>

                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="mt-5 pt-5 border-t border-slate-200">

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-sm transition">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">

            <div class="flex flex-wrap gap-3">

                <input type="text" placeholder="Cari barang..."
                    class="border border-slate-300 rounded-lg px-4 py-2 min-w-[250px]">

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <button class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50">

                    Reset

                </button>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead class="bg-slate-50 text-slate-700">

                    <tr>

                        <th class="px-4 py-3 text-left font-semibold border">No</th>
                        <th class="px-4 py-3 text-left font-semibold border">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold border">Kode Part</th>
                        <th class="px-4 py-3 text-left font-semibold border">Nama Barang</th>
                        <th class="px-4 py-3 text-left font-semibold border">Jumlah</th>
                        <th class="px-4 py-3 text-left font-semibold border">Harga Beli</th>
                        <th class="px-4 py-3 text-left font-semibold border">Supplier</th>
                        <th class="px-4 py-3 text-center font-semibold border">Aksi</th>

                    </tr>

                </thead>

                <tbody class="bg-white">

                    @forelse($barangMasuks as $item)

                    <tr class="hover:bg-slate-50">

                        <td class="px-4 py-4 border">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->tanggal }}
                        </td>

                        <td class="px-4 py-4 border font-mono">
                            {{ $item->barang?->kode ?? '-' }}
                        </td>

                        <td class="px-4 py-4 border font-medium">
                            {{ $item->barang?->nama_barang ?? '-' }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->jumlah }}
                        </td>

                        <td class="px-4 py-4 border">
                            Rp {{ number_format($item->harga_beli,0,',','.') }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->supplier?->nama_supplier ?? '-' }}
                        </td>

                        <td class="px-4 py-4 border text-center">

                            <div class="flex justify-center gap-2">

                                <button
                                    class="px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg shadow-sm transition">
                                    <i class="fas fa-pen mr-1"></i>
                                    Edit
                                </button>

                                <button
                                    class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center py-10 text-slate-500">

                            Tidak ada data barang masuk

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="flex justify-between items-center px-4 py-3 border-t bg-white">

            <div class="text-sm text-gray-600">
                Showing
                {{ $barangMasuks->firstItem() ?? 0 }}
                to
                {{ $barangMasuks->lastItem() ?? 0 }}
                of
                {{ $barangMasuks->total() }}
                entries
            </div>

            <div class="flex items-center gap-2">

                <a href="{{ $barangMasuks->previousPageUrl() }}"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ !$barangMasuks->onFirstPage() ? '' : 'pointer-events-none opacity-50' }}">
                    Previous
                </a>

                <span class="border px-4 py-2 rounded bg-gray-100 font-medium">
                    {{ $barangMasuks->currentPage() }}
                </span>

                <a href="{{ $barangMasuks->nextPageUrl() }}"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ $barangMasuks->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                    Next
                </a>

            </div>

        </div>

    </div>
</div>

@endsection