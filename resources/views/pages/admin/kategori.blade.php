@extends('layouts.app')

@section('title', 'Kategori')

@section('icon')
<i class="fas fa-folder text-blue-600"></i>
@endsection

@section('content')

<div class="mb-8 flex justify-between items-center">

    <div class="relative w-64">
        <input id="searchKategori"
               type="text"
               placeholder="Cari kategori..."
               class="w-full pl-11 pr-4 py-2 rounded-xl border border-slate-200 bg-white shadow-sm 
                      focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

        <i class="fas fa-search absolute left-4 top-3 text-slate-400"></i>

        <div id="suggestBox"
             class="absolute w-full bg-white mt-2 rounded-xl shadow-lg border hidden z-50 max-h-48 overflow-y-auto">
        </div>
    </div>

    <button class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow">
        <i class="fas fa-plus mr-2"></i> Tambah
    </button>

</div>

<div id="kategoriContainer" class="grid md:grid-cols-4 gap-6">

    @foreach($kategori as $item)
    <div class="kategori-item bg-white rounded-2xl shadow hover:shadow-2xl transition group overflow-hidden">

        <div class="h-32 bg-slate-200 relative overflow-hidden">

            <img src="{{ $item->foto ?? asset('images/default.jpg') }}"
                 class="w-full h-full object-cover">

            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                <div class="bg-white p-2 rounded-lg shadow cursor-pointer editBtn">
                    <i class="fas fa-pen text-blue-500 text-sm"></i>
                </div>
            </div>

            <span class="absolute bottom-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-lg">
                Aktif
            </span>

        </div>

        <div class="p-5">
            <h3 class="text-lg font-bold text-slate-800 kategori-nama">
                {{ $item->nama }}
            </h3>

            <p class="text-sm text-slate-400 mt-1 kategori-jumlah">
                {{ $item->barang_count }} Barang
            </p>
        </div>

    </div>
    @endforeach

</div>

<div id="noResult" class="hidden text-center mt-10">
    <h2 class="text-xl font-semibold text-slate-600">😕 Tidak ditemukan</h2>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-96 shadow-xl">

        <h2 class="text-lg font-bold mb-4">Edit Kategori</h2>

        <input type="text" id="editNama" class="w-full mb-3 p-2 border rounded-xl">
        <input type="number" id="editJumlah" class="w-full mb-3 p-2 border rounded-xl">

        <select id="editStatus" class="w-full mb-3 p-2 border rounded-xl">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>

        <input type="file" id="editFoto" class="mb-3 w-full">

        <img id="previewFoto" class="hidden w-full h-40 object-cover rounded-xl mb-4">

        <div class="flex justify-end gap-3">
            <button onclick="closeModal()" class="px-4 py-2 bg-slate-300 rounded-xl">Batal</button>
            <button onclick="saveEdit()" class="px-4 py-2 bg-blue-600 text-white rounded-xl">Simpan</button>
        </div>

    </div>
</div>


@endsection


@section('script')

@endsection