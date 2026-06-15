@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

    <div class="w-full space-y-4">

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            <div class="p-4">
                <button onclick="openTambah()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Kategori
                </button>
            </div>

            <form method="GET" action="{{ url('/admin/kategori') }}">
                <div class="px-4 pb-4 flex flex-wrap items-center gap-3">
                    <select name="search"
                        class="border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}" {{ request('search') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ url('/admin/kategori') }}"
                        class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">
                        Reset
                    </a>
                </div>
            </form>

            {{-- GRID KATEGORI --}}
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($kategori as $item)
                        <div class="card bg-white border border-slate-200 rounded-xl shadow-sm
                            hover:shadow-md transition-all duration-200"
                            data-id="{{ $item->id }}">

                            {{-- IMAGE --}}
                            <div class="relative">
                                @if ($item->foto)
                                    <img src="{{ asset($item->foto) }}" class="w-full h-36 object-cover rounded-t-xl">
                                @else
                                    <div class="w-full h-36 bg-slate-100 rounded-t-xl
                                        flex flex-col items-center justify-center gap-1">
                                        <i class="fas fa-box-open text-4xl text-slate-300"></i>
                                        <span class="text-xs text-slate-400">Belum ada gambar</span>
                                    </div>
                                @endif

                                {{-- BADGE JUMLAH --}}
                                <span class="absolute top-2.5 right-2.5 bg-white/90 text-slate-600
                                    px-2.5 py-1 rounded-full text-xs font-semibold border border-slate-200 shadow-sm">
                                    {{ $item->barang_count }} barang
                                </span>
                            </div>

                            {{-- BODY --}}
                            <div class="px-4 py-3 flex items-center justify-between">
                                <h2 class="font-bold text-slate-800 text-sm">
                                    {{ $item->nama_kategori }}
                                </h2>

                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.data-barang.index', ['kategori_id' => $item->id]) }}"
                                        class="px-3 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded-lg shadow-sm transition text-sm">
                                        <i class="fas fa-boxes text-xs"></i> Barang
                                    </a>
                                    <button type="button"
                                        onclick="openEdit('{{ $item->id }}','{{ addslashes($item->nama_kategori) }}')"
                                        class="px-3 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white transition text-sm">
                                        <i class="fas fa-pen mr-1"></i> Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.kategori.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this.form)"
                                            class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition text-sm">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    @if ($kategori->isEmpty())
                        <div class="col-span-3 py-16 text-center text-slate-400">
                            <i class="fas fa-layer-group text-4xl mb-3 block text-slate-300"></i>
                            Belum ada kategori
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    {{-- MODAL KATEGORI --}}
    <div id="modalKategori"
        data-store-url="{{ route('admin.kategori.store') }}"
        class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 p-4">
        <div class="relative bg-white w-full max-w-lg rounded-xl border border-slate-200 shadow-2xl overflow-hidden"
            onclick="event.stopPropagation()">

            {{-- HEADER --}}
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 id="modalTitleKategori" class="text-lg font-bold text-slate-800">Tambah Kategori</h2>
                    <p id="modalSubtitleKategori" class="text-xs text-slate-500 mt-0.5">Lengkapi data kategori baru.</p>
                </div>
                <button type="button" onclick="closeKategoriModal()"
                    class="w-8 h-8 rounded-lg hover:bg-slate-200 text-slate-500 hover:text-red-500 transition
                    flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- FORM --}}
            <form id="formKategori" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.kategori.store') }}" class="p-6">
                @csrf
                <div id="methodContainerKategori"></div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="kategoriNama"
                            placeholder="Contoh: Mesin, Body, Elektrikal..." required
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm
                            outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Foto Kategori <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        <input type="file" name="foto" accept="image/*"
                            class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm
                            outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG • Maks 2MB</p>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-200">
                    <button type="button" onclick="closeKategoriModal()"
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm rounded-lg transition">
                        Batal
                    </button>
                    <button id="submitKategoriBtn" type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
                        rounded-lg shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span id="submitKategoriBtnText">Simpan Kategori</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection