@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<div class="space-y-6">

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-semibold text-slate-800">
                Data Barang Keluar
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Daftar seluruh transaksi barang keluar.
            </p>
        </div>

        {{-- FILTER --}}
        <div class="p-4 border-b border-slate-200">

            <form method="GET" class="flex flex-wrap gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari barang..."
                    class="w-56 px-4 py-2 border border-slate-300 rounded-lg">

                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">

                    Filter

                </button>

                <a
                    href="{{ route('manager.barang-keluar.index') }}"
                    class="px-5 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">

                    Reset

                </a>

            </form>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 text-slate-700">

                    <tr>
                        <th class="px-4 py-3 text-left font-semibold border">No</th>
                        <th class="px-4 py-3 text-left font-semibold border">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold border">Kode Part</th>
                        <th class="px-4 py-3 text-left font-semibold border">Nama Barang</th>
                        <th class="px-4 py-3 text-left font-semibold border">Jumlah Keluar</th>
                        <th class="px-4 py-3 text-left font-semibold border">Harga Jual</th>
                        <th class="px-4 py-3 text-left font-semibold border">Total</th>
                    </tr>

                </thead>

                <tbody class="bg-white">

                    @forelse($barangKeluars as $item)

                    <tr class="hover:bg-slate-50">

                        <td class="px-4 py-4 border">
                            {{ $barangKeluars->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->tanggal }}
                        </td>

                        <td class="px-4 py-4 border">
                            {{ $item->barang?->kode ?? '-' }}
                        </td>

                        <td class="px-4 py-4 border font-medium">
                            {{ $item->barang?->nama_barang ?? '-' }}
                        </td>

                        <td class="px-4 py-4 border">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                {{ $item->jumlah }}
                            </span>

                        </td>

                        <td class="px-4 py-4 border">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-4 border font-semibold">
                            Rp {{ number_format($item->jumlah * $item->harga_jual, 0, ',', '.') }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">
                            Tidak ada data barang keluar
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="flex justify-between items-center px-4 py-3 border-t bg-white">

            <div class="text-sm text-gray-600">
                Showing
                {{ $barangKeluars->firstItem() ?? 0 }}
                to
                {{ $barangKeluars->lastItem() ?? 0 }}
                of
                {{ $barangKeluars->total() }}
                entries
            </div>

            <div class="flex items-center gap-2">

                <a href="{{ $barangKeluars->previousPageUrl() }}"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ !$barangKeluars->onFirstPage() ? '' : 'pointer-events-none opacity-50' }}">
                    Previous
                </a>

                <span class="border px-4 py-2 rounded bg-gray-100 font-medium">
                    {{ $barangKeluars->currentPage() }}
                </span>

                <a href="{{ $barangKeluars->nextPageUrl() }}"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ $barangKeluars->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                    Next
                </a>

            </div>

        </div>

    </div>

</div>

@endsection