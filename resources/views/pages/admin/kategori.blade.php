blade
@extends('layouts.app')

@section('title','Kategori Sparepart')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <div>
    <h1 class="text-2xl font-semibold text-black-500">
         Kelola kategori dan kelompokkan barang dengan lebih mudah
    </h1>
  
</div>
    </div>

   <button
    onclick="openTambah()"
    class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-3 rounded-xl shadow-lg transition">

    <i class="fas fa-plus"></i>
    Tambah Kategori

</button>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">
    {{ session('success') }}
</div>

@endif

<div class="bg-white border rounded-xl p-4 mb-5 shadow-sm">

    <div class="flex justify-start">

        <div class="flex items-center gap-2">

            <select
                id="filterKategori"
                class="border border-gray-300 px-4 py-3 rounded-xl min-w-[250px]">

                <option value="all">
                    Semua Kategori
                </option>

                @foreach($kategori as $k)

                <option value="{{ $k->id }}">
                    {{ $k->nama_kategori }}
                </option>

                @endforeach

            </select>

            <button
                id="resetFilter"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                <i class="fas fa-filter"></i>

            </button>

        </div>

    </div>

</div>
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 w-full">
@foreach($kategori as $item)

<div
    class="card w-full bg-white border border-gray-100 rounded-2xl p-5 shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
    data-id="{{ $item->id }}">

    <div class="flex justify-between items-start">
        <h2 class="nama text-xl font-bold">
            {{ $item->nama_kategori }}
        </h2>

       <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-semibold">
            {{ $item->barang_count ?? 0 }} barang
        </span>
    </div>

    @if($item->foto)

        <img
            src="{{ asset($item->foto) }}"
            class="w-full h-40 object-cover rounded-xl mt-3">

    @else

       <div class="w-full h-44 bg-gradient-to-br from-gray-50 to-gray-200 rounded-2xl mt-3 flex flex-col items-center justify-center">
    <i class="fas fa-box-open text-5xl text-gray-400"></i>
    <span class="text-sm text-gray-500 mt-2">
        Belum ada gambar
    </span>
</div>
    @endif

   <div class="grid grid-cols-3 gap-2 mt-4">

    <a
        href="{{ route('admin.data-barang.index',['kategori_id'=>$item->id]) }}"
        class="w-full h-12 flex items-center justify-center bg-slate-700 hover:bg-slate-800 text-white rounded-lg font-semibold">
        Barang
    </a>

    <button
        type="button"
        onclick="openEdit('{{ $item->id }}','{{ $item->nama_kategori }}')"
        class="w-full h-12 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
        Edit
    </button>

    <form
        method="POST"
        action="{{ route('admin.kategori.destroy',$item->id) }}"
        onsubmit="return confirm('Yakin hapus kategori ini?')"
        class="w-full">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="w-full h-12 flex items-center justify-center bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold">
            Hapus
        </button>

    </form>

</div>
</div> {{-- PENUTUP CARD YANG HILANG --}}

@endforeach

</div>

<div
    id="modalTambah"
    onclick="if(event.target==this) closeTambah()"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white p-5 rounded-xl w-96 relative">

        <button
            type="button"
            onclick="closeTambah()"
            class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-xl font-bold">

            ✕

        </button>

        <form
            method="POST"
            action="{{ route('admin.kategori.store') }}"
            enctype="multipart/form-data">

            @csrf

            <h2 class="font-bold text-xl mb-4">
                Tambah Kategori
            </h2>

            <input
                name="nama_kategori"
                class="w-full border p-3 rounded mb-3"
                placeholder="Nama kategori">

            <input
                type="file"
                name="foto"
                class="w-full border p-2 rounded mb-3">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white w-full py-3 rounded">

                Simpan

            </button>

        </form>

    </div>

</div>

<div
    id="modalEdit"
    onclick="if(event.target==this) closeEdit()"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white p-5 rounded-xl w-96 relative">

        <button
            type="button"
            onclick="closeEdit()"
            class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-xl font-bold">

            ✕

        </button>

        <form
            id="formEdit"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <h2 class="font-bold text-xl mb-4">
                Edit Kategori
            </h2>

            <input
                id="editNama"
                name="nama_kategori"
                class="w-full border p-3 rounded mb-3">

            <input
                type="file"
                name="foto"
                class="w-full border p-2 rounded mb-3">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white w-full py-3 rounded">

                Update

            </button>

        </form>

    </div>

</div>

<script>

function openTambah()
{
    document.getElementById('modalTambah').classList.remove('hidden');
}

function closeTambah()
{
    document.getElementById('modalTambah').classList.add('hidden');
}

function openEdit(id,nama)
{
    document.getElementById('modalEdit').classList.remove('hidden');

    document.getElementById('editNama').value = nama;

    document.getElementById('formEdit').action =
    '/admin/kategori/' + id;
}

function closeEdit()
{
    document.getElementById('modalEdit').classList.add('hidden');
}


document.getElementById('filterKategori')
.addEventListener('change', function(){

    let kategori = this.value;

    document.querySelectorAll('.card')
    .forEach(card => {

        if(kategori === 'all')
        {
            card.style.display = 'block';
            return;
        }

        if(card.dataset.id === kategori)
        {
            card.style.display = 'block';
        }
        else
        {
            card.style.display = 'none';
        }

    });

});

document.getElementById('resetFilter')
.addEventListener('click', function(){

    document.getElementById('filterKategori').value = 'all';

    document.querySelectorAll('.card')
    .forEach(card => {

        card.style.display = 'block';

    });

});

</script>

@endsection
```
