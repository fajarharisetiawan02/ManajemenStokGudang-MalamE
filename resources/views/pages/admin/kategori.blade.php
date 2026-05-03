@extends('layouts.app')

@section('title', 'Kategori')

@section('icon')
<i class="fas fa-folder text-blue-600"></i>
@endsection

@section('content')

<!-- ================= HEADER ================= -->
<div class="mb-6 flex flex-wrap justify-between items-center gap-4">

    <!-- SEARCH -->
    <div class="relative w-64">
        <input id="searchKategori"
               type="text"
               placeholder="Cari kategori..."
               class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 bg-white shadow-sm 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm transition">

        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>

        <div id="suggestBox"
             class="absolute w-full bg-white mt-2 rounded-xl shadow-lg border hidden z-50 max-h-48 overflow-y-auto">
        </div>
    </div>

    <!-- BUTTON -->
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition flex items-center gap-2">
        <i class="fas fa-plus text-sm"></i>
        Tambah
    </button>

</div>


<!-- ================= GRID ================= -->
<div id="kategoriContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

    @foreach($kategori as $item)
    <div class="kategori-item bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden group relative">

        <!-- IMAGE -->
        <div class="h-32 bg-gray-100 relative overflow-hidden">

            <img src="{{ $item->foto ?? asset('images/default.jpg') }}"
                 class="w-full h-full object-cover">

            <!-- ACTION -->
            <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                <button class="bg-white p-1.5 rounded-md shadow editBtn">
                    <i class="fas fa-pen text-blue-500 text-xs"></i>
                </button>
                <button class="bg-white p-1.5 rounded-md shadow deleteBtn">
                    <i class="fas fa-trash text-red-500 text-xs"></i>
                </button>
            </div>

            <!-- STATUS -->
            <span class="absolute bottom-2 left-2 px-2 py-1 text-xs rounded-full
                {{ ($item->status ?? 'aktif') == 'aktif' 
                    ? 'bg-green-100 text-green-600' 
                    : 'bg-gray-200 text-gray-500' }}">
                {{ ucfirst($item->status ?? 'aktif') }}
            </span>

        </div>

        <!-- CONTENT -->
        <div class="p-4">
            <h3 class="text-base font-semibold text-gray-800 kategori-nama">
                {{ $item->nama }}
            </h3>

            <p class="text-sm text-gray-500 mt-1 kategori-jumlah">
                {{ $item->barang_count }} item
            </p>
        </div>

    </div>
    @endforeach

</div>


<!-- EMPTY -->
<div id="noResult" class="hidden text-center mt-10">
    <h2 class="text-lg font-semibold text-gray-500">😕 Tidak ditemukan</h2>
</div>


<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 w-96 shadow-xl">

        <h2 class="text-lg font-semibold mb-4">Edit Kategori</h2>

        <input type="text" id="editNama"
            class="w-full mb-3 p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">

        <input type="number" id="editJumlah"
            class="w-full mb-3 p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">

        <select id="editStatus"
            class="w-full mb-3 p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>

        <input type="file" id="editFoto"
            class="mb-3 w-full text-sm">

        <img id="previewFoto"
            class="hidden w-full h-36 object-cover rounded-xl mb-4">

        <div class="flex justify-end gap-2">
            <button onclick="closeModal()"
                class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                Batal
            </button>

            <button onclick="saveEdit()"
                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>

    </div>

</div>

@endsection


@section('script')
@endsection