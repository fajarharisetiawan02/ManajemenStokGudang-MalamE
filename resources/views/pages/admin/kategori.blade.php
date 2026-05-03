@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<!-- HEADER -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-6">

    <!-- SEARCH -->
    <div class="relative w-full md:w-1/3">
        <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
        <input type="text" id="searchInput"
            placeholder="Cari kategori..."
            class="w-full pl-10 pr-3 py-2 rounded-xl border bg-white shadow-sm
                   focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
    </div>

    <!-- BUTTON -->
    <button onclick="openModalTambah()"
        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-2 rounded-xl shadow-md">
        + Tambah Kategori
    </button>

</div>

<!-- FILTER -->
<div class="flex flex-wrap gap-2 mb-6">

    <button onclick="setFilter('all',this)" class="tabBtn activeTab">SEMUA</button>
    <button onclick="setFilter('engine',this)" class="tabBtn">ENGINE</button>
    <button onclick="setFilter('electrical',this)" class="tabBtn">ELECTRICAL</button>
    <button onclick="setFilter('suspension',this)" class="tabBtn">SUSPENSION</button>
    <button onclick="setFilter('body',this)" class="tabBtn">BODY</button>

</div>

<!-- GRID -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($kategori as $item)

@php
    $foto = $item->foto;
    $fotoUrl = ($foto && file_exists(public_path($foto)))
        ? asset($foto)
        : 'https://via.placeholder.com/400x300?text=No+Image';
@endphp

<div class="kategori-item bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition"
     data-kategori="{{ strtolower($item->kelompok ?? 'body') }}">

    <!-- FOTO -->
    <div class="h-44 bg-gray-100 overflow-hidden">
        <img src="{{ $fotoUrl }}"
            class="w-full h-full object-cover hover:scale-110 transition duration-500">
    </div>

    <!-- CONTENT -->
    <div class="p-5">

        <h3 class="font-bold text-lg">{{ $item->nama }}</h3>
        <p class="text-sm text-gray-500">{{ $item->jumlah }} item</p>

        <span class="inline-block mt-3 text-xs px-3 py-1 rounded-full bg-blue-50 text-blue-600 uppercase">
            {{ $item->kelompok ?? 'body' }}
        </span>

        <!-- ACTION -->
        <div class="flex justify-end gap-2 mt-5">

            <button onclick="openEditModal(this)"
                data-id="{{ $item->id }}"
                data-nama="{{ $item->nama }}"
                data-jumlah="{{ $item->jumlah }}"
                data-status="{{ $item->status }}"
                data-kelompok="{{ strtolower($item->kelompok ?? 'body') }}"
                data-foto="{{ $item->foto }}"
                class="px-3 py-1 text-sm bg-gray-100 rounded-lg">
                ✏️ Edit
            </button>

            <form action="{{ route('kategori.destroy',$item->id) }}" method="POST">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus data ini?')"
                    class="px-3 py-1 text-sm bg-red-100 text-red-600 rounded-lg">
                    🗑 Hapus
                </button>
            </form>

        </div>

    </div>
</div>

@endforeach

</div>

<!-- EMPTY -->
<div id="emptyState" class="hidden text-center text-gray-400 mt-10">
    📦 Tidak ada data ditemukan
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah"
     class="fixed inset-0 hidden items-center justify-center bg-black/40 backdrop-blur-sm z-50">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl">

        <div class="p-5 bg-blue-600 text-white font-bold">
            Tambah Kategori
        </div>

        <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data"
              class="p-5 space-y-3">
            @csrf

            <input name="nama" placeholder="Nama" class="w-full border p-2 rounded-xl">
            <input name="jumlah" type="number" placeholder="Jumlah" class="w-full border p-2 rounded-xl">

            <select name="status" class="w-full border p-2 rounded-xl">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>

            <select name="kelompok" class="w-full border p-2 rounded-xl">
                <option value="engine">Engine</option>
                <option value="electrical">Electrical</option>
                <option value="suspension">Suspension</option>
                <option value="body">Body</option>
            </select>

            <input type="file" name="foto" class="w-full border p-2 rounded-xl">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModalTambah()" class="px-4 py-2 bg-gray-100 rounded-xl">Batal</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-xl">Simpan</button>
            </div>

        </form>

    </div>
</div>

<!-- ================= MODAL EDIT (FIX FOTO FULL) ================= -->
<div id="modalEdit"
     class="fixed inset-0 hidden items-center justify-center bg-black/40 backdrop-blur-sm z-50">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl">

        <div class="p-5 bg-green-600 text-white font-bold">
            Edit Kategori
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data"
              class="p-5 space-y-3">

            @csrf @method('PUT')

            <input id="editNama" name="nama" class="w-full border p-2 rounded-xl">
            <input id="editJumlah" name="jumlah" class="w-full border p-2 rounded-xl">

            <select id="editStatus" name="status" class="w-full border p-2 rounded-xl">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>

            <select id="editKelompok" name="kelompok" class="w-full border p-2 rounded-xl">
                <option value="engine">Engine</option>
                <option value="electrical">Electrical</option>
                <option value="suspension">Suspension</option>
                <option value="body">Body</option>
            </select>

            <!-- FOTO EDIT FIX -->
            <div class="space-y-2">

                <div class="text-sm text-gray-500">Foto saat ini:</div>

                <img id="previewFoto"
                    class="w-full h-32 object-cover rounded-xl border bg-gray-100">

                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="hapus_foto" value="1">
                    Hapus foto
                </label>

                <input type="file" name="foto" class="w-full border p-2 rounded-xl">

            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModalEdit()" class="px-4 py-2 bg-gray-100 rounded-xl">Batal</button>
                <button class="px-4 py-2 bg-green-600 text-white rounded-xl">Update</button>
            </div>

        </form>

    </div>
</div>

@endsection

@section('script')
<script>

let currentFilter = 'all';

/* MODAL */
function openModalTambah(){
    document.getElementById('modalTambah').classList.remove('hidden');
    document.getElementById('modalTambah').classList.add('flex');
}

function closeModalTambah(){
    document.getElementById('modalTambah').classList.add('hidden');
}

function openEditModal(btn){

    editNama.value = btn.dataset.nama;
    editJumlah.value = btn.dataset.jumlah;
    editStatus.value = btn.dataset.status;
    editKelompok.value = btn.dataset.kelompok;

    editForm.action = '/kategori/' + btn.dataset.id;

    let foto = btn.dataset.foto;
    let preview = document.getElementById('previewFoto');

    if(foto && foto !== ""){
        preview.src = "/" + foto;
    } else {
        preview.src = "https://via.placeholder.com/400x300?text=No+Image";
    }

    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('modalEdit').classList.add('flex');
}

function closeModalEdit(){
    document.getElementById('modalEdit').classList.add('hidden');
}

/* SEARCH + FILTER */
document.getElementById('searchInput').addEventListener('input', apply);

function setFilter(filter, el){

    currentFilter = filter;

    document.querySelectorAll('.tabBtn').forEach(b=>{
        b.classList.remove('activeTab');
    });

    el.classList.add('activeTab');

    apply();
}

function apply(){

    let q = document.getElementById('searchInput').value.toLowerCase();
    let items = document.querySelectorAll('.kategori-item');

    let count = 0;

    items.forEach(item=>{

        let nama = item.querySelector('h3').innerText.toLowerCase();
        let kat = item.dataset.kategori;

        let ok = nama.includes(q) && (currentFilter === 'all' || kat === currentFilter);

        item.style.display = ok ? 'block' : 'none';

        if(ok) count++;

    });

    document.getElementById('emptyState').style.display =
        count === 0 ? 'block' : 'none';
}

</script>

<style>
.tabBtn{
    padding:6px 12px;
    border-radius:10px;
    background:#f3f4f6;
    cursor:pointer;
}
.tabBtn:hover{background:#e5e7eb}

.activeTab{
    background:#111827;
    color:white;
}
</style>

@endsection