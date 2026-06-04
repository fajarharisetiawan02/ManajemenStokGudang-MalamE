@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

<div class="space-y-5">

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-semibold text-slate-800">
                Data Barang Masuk
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Daftar seluruh transaksi barang masuk.
            </p>
        </div>

        {{-- FILTER --}}
        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">

            <form method="GET" class="flex flex-wrap gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari barang..."
                    class="border border-slate-300 rounded-lg px-4 py-2 min-w-[250px]">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <a
                    href="{{ route('manager.barang-masuk.index') }}"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50">

                    Reset

                </a>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead class="bg-slate-50 text-slate-700">

                    <tr>

                        <th class="px-4 py-3 text-left font-semibold border">
                            No
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Tanggal
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Kode Part
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Nama Barang
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Jumlah
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Harga Beli
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Supplier
                        </th>

                    </tr>

                </thead>

                <tbody class="bg-white">

                    @forelse($barangMasuks as $item)

                    <tr class="hover:bg-slate-50">

                        <td class="px-4 py-4 border">
                            {{ $barangMasuks->firstItem() + $loop->index }}
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
                            Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->supplier?->nama_supplier ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-10 text-slate-500">

                            Tidak ada data barang masuk

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
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