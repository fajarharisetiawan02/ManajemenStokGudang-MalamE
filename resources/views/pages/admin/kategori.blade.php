@extends('layouts.app')

@section('title', __('app.title_kategori'))
@section('page_title', __('app.kategori'))

@section('content')

    <div class="w-full space-y-4">

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            <div class="p-4">
                <button onclick="openTambah()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow-sm transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Kategori
                </button>
            </div>

            <form method="GET" action="{{ url('/admin/kategori') }}">
                <div class="px-4 pb-4 flex flex-wrap items-center gap-3">
                    <select name="search"
                        class="border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}" {{ request('search') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow-sm transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ url('/admin/kategori') }}"
                        class="border border-slate-300 px-4 py-2.5 rounded-lg hover:bg-slate-50 transition">
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
                            <div class="px-4 py-3 flex items-center justify-between gap-2">
                                <h2 class="font-bold text-slate-800 text-sm truncate flex-1 min-w-0 mr-2">
                                    {{ $item->nama_kategori }}
                                </h2>
                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                    <a href="{{ route('admin.data-barang.index', ['kategori_id' => $item->id]) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 md:w-auto md:h-auto md:px-3 md:py-2 bg-slate-700 hover:bg-slate-800 text-white text-sm rounded-lg transition">
                                        <i class="fas fa-box md:mr-1"></i><span class="hidden md:inline"> Barang</span>
                                    </a>
                                    <button type="button"
                                        onclick="openEdit('{{ $item->id }}','{{ addslashes($item->nama_kategori) }}')"
                                        class="inline-flex items-center justify-center w-9 h-9 md:w-auto md:h-auto md:px-3 md:py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-lg transition">
                                        <i class="fas fa-pen md:mr-1"></i><span class="hidden md:inline"> Edit</span>
                                    </button>
                                    <form method="POST" action="{{ route('admin.kategori.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this.form)"
                                            class="inline-flex items-center justify-center w-9 h-9 md:w-auto md:h-auto md:px-3 md:py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition">
                                            <i class="fas fa-trash md:mr-1"></i><span class="hidden md:inline"> Hapus</span>
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
        class="fixed z-[9999] hidden items-start justify-center overflow-y-auto backdrop-blur-sm bg-black/40"
        style="top:0;left:0;right:0;bottom:0;margin:0;padding:1.5rem 1rem;">
        <div class="bg-white w-full max-w-3xl rounded-xl shadow-2xl border border-slate-200 flex flex-col my-auto"
            onclick="event.stopPropagation()">

            {{-- HEADER --}}
            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between rounded-t-xl">
                <div>
                    <h2 id="modalTitleKategori" class="text-xl font-bold text-slate-800">Tambah Kategori</h2>
                    <p id="modalSubtitleKategori" class="text-sm text-slate-500 mt-1">Lengkapi data kategori baru.</p>
                </div>
                <button type="button" onclick="closeKategoriModal()"
                    class="w-9 h-9 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-red-500 transition flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- FORM --}}
            <form id="formKategori" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.kategori.store') }}" class="p-6" autocomplete="off">
                @csrf
                <div id="methodContainerKategori"></div>

                <div class="grid md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="kategoriNama"
                            placeholder="Contoh: Mesin, Body, Elektrikal..." required
                            class="w-full mt-2 border border-slate-300 rounded-lg px-4 py-2.5 text-sm text-slate-800
                            outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white
                            placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">
                            Foto Kategori <span class="text-slate-400">(Opsional)</span>
                        </label>
                        <div onclick="document.getElementById('input_foto').click()"
                            class="border-2 border-dashed border-slate-300 bg-slate-50 rounded-lg p-5 text-center hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer mt-2">
                            <input type="file" name="foto" id="input_foto" class="hidden"
                                onclick="event.stopPropagation()">
                            <i class="fas fa-cloud-upload-alt text-2xl text-slate-400 mb-2 block"></i>
                            <p class="text-sm text-slate-500 font-medium">Klik untuk upload foto</p>
                            <p class="mt-1 text-xs text-slate-400">Format: JPG, PNG • Maks 2MB</p>
                            <p id="foto_label" class="mt-2 text-xs text-blue-600 font-medium"></p>
                        </div>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-slate-200">
                    <button type="button" onclick="closeKategoriModal()"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg transition">
                        Batal
                    </button>
                    <button id="submitKategoriBtn" type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                        <span id="submitKategoriBtnText">Simpan</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection