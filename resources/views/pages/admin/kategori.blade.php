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
                   focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <!-- BUTTON -->
    <button onclick="openModalTambah()"
        class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow-md">
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
$fotoUrl = ($item->foto && file_exists(public_path($item->foto)))
    ? asset($item->foto)
    : 'https://via.placeholder.com/400x300?text=No+Image';
@endphp

<div class="kategori-item bg-white rounded-2xl overflow-hidden shadow"
     data-kategori="{{ strtolower($item->kelompok ?? 'body') }}">

    <!-- FOTO -->
    <div class="h-44 bg-gray-100 overflow-hidden">
        <img src="{{ $fotoUrl }}"
            class="w-full h-full object-cover hover:scale-110 transition">
    </div>

    <!-- CONTENT -->
    <div class="p-5">
        <h3 class="font-bold text-lg">{{ $item->nama }}</h3>
        <p class="text-sm text-gray-500">{{ $item->jumlah }} item</p>

        <span class="inline-block mt-3 text-xs px-3 py-1 rounded-full bg-blue-50 text-blue-600 uppercase">
            {{ $item->kelompok }}
        </span>

        <!-- ACTION -->
        <div class="flex justify-end gap-2 mt-5">

            <!-- EDIT -->
            <button onclick="openEditModal(this)"
                data-id="{{ $item->id }}"
                data-nama="{{ $item->nama }}"
                data-jumlah="{{ $item->jumlah }}"
                data-status="{{ $item->status }}"
                data-kelompok="{{ $item->kelompok }}"
                class="px-3 py-1 text-sm bg-gray-100 rounded-lg">
                ✏️ Edit
            </button>

            <!-- DELETE -->
            <form action="{{ route('kategori.destroy',$item->id) }}"
                  method="POST"
                  onsubmit="return confirmDelete(event)">
                @csrf
                @method('DELETE')

                <button type="submit"
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
    Tidak ada data ditemukan
</div>

<!-- MODAL TAMBAH -->
<div id="modalTambah" class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="w-full max-w-md bg-white rounded-2xl">

        <div class="p-5 bg-blue-600 text-white font-bold">
            Tambah Kategori
        </div>

        <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data"
              class="p-5 space-y-3">
            @csrf

            <input name="nama" class="w-full border p-2 rounded-xl" placeholder="Nama">
            <input name="jumlah" type="number" class="w-full border p-2 rounded-xl" placeholder="Jumlah">

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

<!-- MODAL EDIT -->
<div id="modalEdit" class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="w-full max-w-md bg-white rounded-2xl">

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

            <input type="file" name="foto" class="w-full border p-2 rounded-xl">

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

// ambil element
const modalTambah = document.getElementById('modalTambah');
const modalEdit = document.getElementById('modalEdit');

const editNama = document.getElementById('editNama');
const editJumlah = document.getElementById('editJumlah');
const editStatus = document.getElementById('editStatus');
const editKelompok = document.getElementById('editKelompok');
const editForm = document.getElementById('editForm');

/* MODAL */
function openModalTambah(){
    modalTambah.classList.remove('hidden');
    modalTambah.classList.add('flex');
}
function closeModalTambah(){
    modalTambah.classList.add('hidden');
    modalTambah.classList.remove('flex');
}

/* EDIT */
function openEditModal(btn){
    editNama.value = btn.dataset.nama;
    editJumlah.value = btn.dataset.jumlah;
    editStatus.value = btn.dataset.status;
    editKelompok.value = btn.dataset.kelompok;

    editForm.action = '/kategori/' + btn.dataset.id;

    modalEdit.classList.remove('hidden');
    modalEdit.classList.add('flex');
}
function closeModalEdit(){
    modalEdit.classList.add('hidden');
    modalEdit.classList.remove('flex');
}

/* DELETE */
function confirmDelete(e){
    if(!confirm('Yakin hapus?')){
        e.preventDefault();
        return false;
    }
    return true;
}

/* SEARCH + FILTER */
let currentFilter = 'all';

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

// jalan pertama
apply();

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