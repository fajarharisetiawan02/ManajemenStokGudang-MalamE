@extends('layouts.app')

@section('title', __('app.barang_keluar'))

@section('content')

<div class="w-full space-y-4">

    {{-- FORM CARD --}}
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
            <div>
                <p id="formSubtitle" class="text-sm text-slate-500 mt-1">
                    Masukkan kode part terlebih dahulu untuk mengecek data barang.
                </p>
            </div>
            <span id="editBadge"
                class="hidden items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700
                text-xs font-semibold rounded-full border border-amber-200">
                <i class="fas fa-pen text-xs"></i> Mode Edit
            </span>
        </div>

        <form id="mainForm" action="{{ route('admin.barang-keluar.store') }}"
            data-store-url="{{ route('admin.barang-keluar.store') }}" method="POST">
            @csrf
            <div id="methodContainer"></div>
            <input type="hidden" name="barang_id" id="barang_id">

            <div class="p-6 space-y-5">

                <div class="grid md:grid-cols-2 gap-5">

                    {{-- TANGGAL --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Tanggal Keluar</label>
                        <input type="date" name="tanggal" id="inputTanggal" required
                            min="{{ date('Y-m-d', strtotime('-3 days')) }}"
                            max="{{ date('Y-m-d') }}"
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white
                            outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    {{-- KODE PART + TOMBOL CEK --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Kode Part</label>
                        <div class="flex gap-2 mt-2">
                            <input type="text" id="kode_part" placeholder="Contoh : BRG-001"
                                class="flex-1 px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 bg-white
                                outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                            <button type="button" id="cekBarang"
                                class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
                                rounded-lg shadow-sm transition flex items-center gap-2">
                                <i class="fas fa-search"></i> Cek Barang
                            </button>
                        </div>
                    </div>

                </div>

                {{-- INFO BARANG --}}
                <div id="infoBarang" class="hidden border-l-4 border-blue-400 bg-blue-50 rounded-lg p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-box-open text-blue-600 text-xs"></i>
                        </div>
                        <h4 class="font-semibold text-slate-800 text-sm">Informasi Barang Ditemukan</h4>
                    </div>
                    <div class="grid md:grid-cols-2 gap-3 mb-3">
                        <div>
                            <p class="text-xs text-slate-500 mb-1 font-medium uppercase tracking-wide">Nama Barang</p>
                            <div id="showNama" class="px-4 py-2.5 bg-white rounded-lg border border-slate-200 text-sm font-medium text-slate-800 shadow-sm"></div>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1 font-medium uppercase tracking-wide">Kategori</p>
                            <div id="showKategori" class="px-4 py-2.5 bg-white rounded-lg border border-slate-200 text-sm font-medium text-slate-800 shadow-sm"></div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-3">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-slate-500 mb-1 font-medium uppercase tracking-wide">Merek</p>
                                <div id="showBrand" class="px-4 py-2.5 bg-white rounded-lg border border-slate-200 text-sm font-medium text-slate-800 shadow-sm"></div>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 mb-1 font-medium uppercase tracking-wide">Tipe Kendaraan</p>
                                <div id="showTipe" class="px-4 py-2.5 bg-white rounded-lg border border-slate-200 text-sm font-medium text-slate-800 shadow-sm"></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1 font-medium uppercase tracking-wide">Stok Saat Ini</p>
                            <div id="showStok" class="flex items-center gap-2"></div>
                        </div>
                    </div>
                </div>

                {{-- JUMLAH + HARGA --}}
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Jumlah Keluar</label>
                        <input type="number" name="jumlah" id="inputJumlah" min="1" required
                            placeholder="Masukkan jumlah"
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 bg-white
                            outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                            placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Harga Jual</label>
                        <input type="number" name="harga_jual" id="inputHarga" min="0" required
                            placeholder="Masukkan harga jual"
                            class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 bg-white
                            outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                            placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    </div>
                </div>

                {{-- TUJUAN --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700">
                        Tujuan <span class="text-slate-400">(Opsional)</span>
                    </label>
                    <input type="text" name="tujuan" id="inputTujuan" placeholder="Contoh: Customer"
                        class="w-full mt-2 px-4 py-2.5 border border-slate-300 rounded-lg text-sm text-slate-800 bg-white
                        outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                        placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                </div>

                {{-- FOOTER BUTTONS --}}
                <div class="pt-5 mt-5 border-t border-slate-200 flex items-center justify-between">
                    <button type="button" id="btnBatal" onclick="resetFormMode()"
                        class="hidden px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700
                        text-sm rounded-lg transition items-center gap-2">
                        Batal Edit
                    </button>
                    <div class="ml-auto flex items-center gap-2">
                        <button type="button" id="btnReset" onclick="resetFormMode()"
                            class="px-5 py-2.5 border border-slate-300 hover:bg-slate-50 text-slate-700
                            text-sm font-medium rounded-lg transition">
                            Reset
                        </button>
                        <button type="submit" id="btnSubmit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
                            rounded-lg shadow-sm transition">
                            <span id="btnSubmitText">Simpan</span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    {{-- TABLE CARD --}}
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- FILTER --}}
        <form method="GET" action="{{ route('admin.barang-keluar.index') }}">
            <div class="px-4 py-4 flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang / tujuan..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 text-sm
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none
                    placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-lg shadow-sm transition">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('admin.barang-keluar.index') }}"
                    class="border border-slate-300 px-4 py-2 text-sm rounded-lg hover:bg-slate-50 transition">
                    Reset
                </a>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-12">No</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Tanggal</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Kode Part</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Nama Barang</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Tujuan</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border">Jumlah Keluar</th>
                        <th class="px-4 py-4 text-right text-sm font-bold border">Harga Jual</th>
                        <th class="px-4 py-4 text-right text-sm font-bold border">Total</th>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($barangKeluars as $item)
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-4 py-4 border text-center text-black">{{ $barangKeluars->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-4 border text-black">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                        <td class="px-4 py-4 border text-black">{{ $item->barang?->kode ?? '-' }}</td>
                        <td class="px-4 py-4 border text-black">{{ $item->barang?->nama_barang ?? '-' }}</td>
                        <td class="px-4 py-4 border text-black">{{ $item->tujuan ?? '-' }}</td>
                        <td class="px-4 py-4 border text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                -{{ $item->jumlah }}
                            </span>
                        </td>
                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-4 py-4 border text-right font-semibold text-slate-700">
                            Rp {{ number_format($item->jumlah * $item->harga_jual, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-4 border">
                            <div class="flex justify-center items-center gap-2 flex-nowrap">
                                <button type="button"
                                    onclick="setEditMode(
                                        {{ $item->id }},
                                        '{{ $item->tanggal }}',
                                        {{ $item->jumlah }},
                                        {{ $item->harga_jual }},
                                        '{{ $item->barang?->kode ?? '' }}',
                                        '{{ addslashes($item->barang?->nama_barang ?? '-') }}',
                                        '{{ addslashes($item->barang?->kategori->nama_kategori ?? '-') }}',
                                        '{{ addslashes(optional($item->barang?->brand)->nama_brand ?? ($item->barang?->brand ?? '-')) }}',
                                        {{ $item->barang?->stok ?? 0 }},
                                        '{{ addslashes($item->tujuan ?? '') }}',
                                        '{{ addslashes($item->barang?->tipe ?? '-') }}'
                                    )"
                                    class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-lg transition whitespace-nowrap">
                                    <i class="fas fa-pen mr-1"></i> Edit
                                </button>
                                <form action="{{ route('admin.barang-keluar.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this.form)"
                                        class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition whitespace-nowrap">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-10 text-center text-gray-500">Belum ada data barang keluar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 px-5 py-4 border-t bg-slate-50">
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold text-slate-800">{{ $barangKeluars->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-800">{{ $barangKeluars->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-blue-600">{{ $barangKeluars->total() }}</span>
                data barang keluar
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ $barangKeluars->previousPageUrl() }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ $barangKeluars->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Sebelumnya
                </a>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold text-xs">
                    {{ $barangKeluars->currentPage() }}
                </span>
                <a href="{{ $barangKeluars->nextPageUrl() }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ !$barangKeluars->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                    Berikutnya
                </a>
            </div>
        </div>

    </div>

</div>

@endsection