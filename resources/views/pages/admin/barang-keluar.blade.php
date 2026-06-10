@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<div class="space-y-6">

    {{-- FORM --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-semibold text-slate-800">
                Form Barang Keluar
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Lengkapi data barang keluar di bawah ini.
            </p>
        </div>

        <form action="{{ route('admin.barang-keluar.store') }}" method="POST" class="p-6">
            @csrf

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm font-medium text-slate-700">
                        Tanggal Keluar
                    </label>

                    <input type="date" name="tanggal" required
                        class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">
                        Barang
                    </label>

                    <select name="barang_id" required
                        class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">

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
                        Jumlah Keluar
                    </label>

                    <input type="number" name="jumlah" required min="1"
                        class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">
                        Harga Jual
                    </label>

                    <input type="number" name="harga_jual" required min="0"
                        class="w-full mt-2 px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

            </div>

            <div class="mt-6 pt-6 border-t border-slate-200">

                <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition font-medium">
                    Simpan
                </button>

            </div>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        {{-- FILTER --}}
        <div class="p-4 border-b border-slate-200">

            <form method="GET" class="flex flex-wrap gap-3">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                    class="w-56 px-4 py-2 border border-slate-300 rounded-lg">

                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                    Filter
                </button>

                <a href="{{ route('admin.barang-keluar.index') }}"
                    class="px-5 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">
                    Reset
                </a>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

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
                            Jumlah Keluar
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Harga Jual
                        </th>

                        <th class="px-4 py-3 text-left font-semibold border">
                            Total
                        </th>
                        <th class="px-4 py-3 text-center font-semibold border">
                            Aksi
                        </th>
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
                        <td class="px-4 py-4 border text-center">

                            <div class="flex justify-center gap-2">

                                <button type="button"
                                        onclick="document.getElementById('editModalKeluar{{ $item->id }}').classList.remove('hidden')"
                                        class="px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg">
                                        <i class="fas fa-pen mr-1"></i>
                                    Edit

                                </button>

                                @foreach($barangKeluars as $item)

                                <div id="editModalKeluar{{ $item->id }}"
                                    class="hidden fixed inset-0 z-50 bg-black/50">

                                    <div class="bg-white w-full max-w-xl mx-auto mt-20 p-6 rounded-lg">

                                        <h2 class="text-lg font-bold mb-4">Edit Barang Keluar</h2>

                                        <form action="{{ route('admin.barang-keluar.update', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <label class="text-sm">Tanggal</label>
                                            <input type="date" name="tanggal"
                                                value="{{ $item->tanggal }}"
                                                class="w-full border p-2 mb-3">

                                            <label class="text-sm">Barang</label>
                                            <select name="barang_id" class="w-full border p-2 mb-3">

                                                @foreach($barangs as $b)
                                                    <option value="{{ $b->id }}"
                                                        {{ $item->barang_id == $b->id ? 'selected' : '' }}>
                                                        {{ $b->kode }} - {{ $b->nama_barang }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            <label class="text-sm">Jumlah</label>
                                            <input type="number" name="jumlah"
                                                value="{{ $item->jumlah }}"
                                                class="w-full border p-2 mb-3">

                                            <label class="text-sm">Harga Jual</label>
                                            <input type="number" name="harga_jual"
                                                value="{{ $item->harga_jual }}"
                                                class="w-full border p-2 mb-3">

                                            <div class="flex justify-end gap-2">

                                                <button type="button"
                                                        onclick="document.getElementById('editModalKeluar{{ $item->id }}').classList.add('hidden')"
                                                        class="px-4 py-2 bg-gray-400 text-white rounded">
                                                    Batal
                                                </button>

                                                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                                                    Update
                                                </button>

                                            </div>

                                        </form>

                                    </div>
                                </div>

                                @endforeach

                                <form action="{{ route('admin.barang-keluar.destroy', $item) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus data ini?')">

                                      @csrf
                                      @method('DELETE')

                                    <button class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus
                                    </button>

                                </form>
                            </div>

                        </td>
                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="px-4 py-10 text-center text-slate-500"> Tidak ada data barang keluar
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