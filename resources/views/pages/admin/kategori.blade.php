@extends('layouts.app')

@section('title','Kategori')

@section('content')

<div class="w-full space-y-4">

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <!-- Tombol -->
        <div class="p-4">

            <button onclick="openTambah()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm">

                <i class="fas fa-plus mr-1"></i>
                Tambah Kategori

            </button>

        </div>

        <!-- FILTER -->
        <div class="px-4 pb-4">

            <div class="flex flex-wrap items-center gap-3">

                <!-- KATEGORI -->
                <select id="filterKategori"
                    class="border border-slate-300 rounded-lg px-4 py-2 min-w-[250px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($kategori as $k)

                    <option value="{{ $k->id }}">
                        {{ $k->nama_kategori }}
                    </option>

                    @endforeach

                </select>

                <!-- FILTER -->
                <button id="btnFilter" type="button"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <!-- RESET -->
                <button id="resetFilter" type="button"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">

                    Reset

                </button>

            </div>

        </div>

        <!-- LIST KATEGORI -->
        <div class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @foreach($kategori as $item)

                <div class="card bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:shadow-lg transition"
                    data-id="{{ $item->id }}">

                    <div class="flex justify-between items-start mb-3">

                        <h2 class="text-xl font-bold text-slate-800">
                            {{ $item->nama_kategori }}
                        </h2>

                        <span
                            class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-semibold border border-slate-200">
                            {{ $item->barang_count }} barang
                        </span>

                    </div>

                    @if($item->foto)

                    <img src="{{ asset($item->foto) }}" class="w-full h-44 object-cover rounded-xl">

                    @else

                    <div class="w-full h-44 bg-slate-100 rounded-xl flex flex-col items-center justify-center">

                        <i class="fas fa-box-open text-5xl text-slate-400"></i>

                        <span class="text-sm text-slate-500 mt-3">
                            Belum ada gambar
                        </span>

                    </div>

                    @endif

                    <div class="grid grid-cols-3 gap-2 mt-4">

                        <a href="{{ route('admin.data-barang.index',['kategori_id'=>$item->id]) }}"
                            class="h-10 flex items-center justify-center bg-slate-700 hover:bg-slate-800 text-white rounded-lg text-sm font-medium transition">
                            Barang
                        </a>

                        <button type="button" onclick="openEdit('{{ $item->id }}','{{ $item->nama_kategori }}')"
                            class="h-10 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium transition">
                            Edit
                        </button>

                        <form method="POST" action="{{ route('admin.kategori.destroy',$item->id) }}"
                            onsubmit="return confirm('Yakin hapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-full h-10 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition">
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

                @endforeach

            </div>

        </div>
    </div>
</div>

<!-- MODAL KATEGORI -->
<div id="modalKategori" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <div class="relative bg-white w-full max-w-2xl rounded-xl border border-slate-200 shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-slate-50 border-b border-slate-200 px-6 py-5 flex items-center justify-between">

            <div>

                <h2 id="modalTitleKategori" class="text-xl font-bold text-slate-800">

                    Tambah Kategori

                </h2>

                <p id="modalSubtitleKategori" class="text-sm text-slate-500 mt-1">

                    Lengkapi data kategori baru di bawah ini.

                </p>

            </div>

            <button type="button" onclick="closeKategoriModal()"
                class="w-9 h-9 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-red-500 transition">

                <i class="fas fa-times"></i>

            </button>

        </div>

        <!-- FORM -->
        <form id="formKategori" method="POST" enctype="multipart/form-data" action="{{ route('admin.kategori.store') }}"
            class="p-6">

            @csrf

            <div id="methodContainerKategori"></div>

            <div class="space-y-4">

                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nama Kategori
                    </label>

                    <input type="text" name="nama_kategori" id="kategoriNama" placeholder="Contoh: Mazda" required
                        class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                </div>

                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Foto Kategori
                    </label>

                    <input type="file" name="foto" class="w-full border border-slate-300 rounded-lg px-4 py-3">

                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-2 mt-6 pt-4 border-t">

                <button type="button" onclick="closeKategoriModal()"
                    class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg">

                    Batal

                </button>

                <button id="submitKategoriBtn" type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm">

                    Simpan Kategori

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function openTambah() {

        document.getElementById('modalKategori').classList.remove('hidden');
        document.getElementById('modalKategori').classList.add('flex');

        document.getElementById('modalTitleKategori').innerText =
            'Tambah Kategori';

        document.getElementById('modalSubtitleKategori').innerText =
            'Lengkapi data kategori baru di bawah ini.';

        document.getElementById('submitKategoriBtn').innerText =
            'Simpan Kategori';

        document.getElementById('submitKategoriBtn').classList.remove(
            'bg-amber-500',
            'hover:bg-amber-600'
        );

        document.getElementById('submitKategoriBtn').classList.add(
            'bg-blue-600',
            'hover:bg-blue-700'
        );

        document.getElementById('formKategori').action =
            "{{ route('admin.kategori.store') }}";

        document.getElementById('methodContainerKategori').innerHTML = '';

        document.getElementById('kategoriNama').value = '';
    }

    function openEdit(id, nama) {

        document.getElementById('modalKategori').classList.remove('hidden');
        document.getElementById('modalKategori').classList.add('flex');

        document.getElementById('modalTitleKategori').innerText =
            'Edit Kategori';

        document.getElementById('modalSubtitleKategori').innerText =
            'Perbarui data kategori di bawah ini.';

        document.getElementById('submitKategoriBtn').innerText =
            'Update Kategori';

        document.getElementById('submitKategoriBtn').classList.remove(
            'bg-blue-600',
            'hover:bg-blue-700'
        );

        document.getElementById('submitKategoriBtn').classList.add(
            'bg-amber-500',
            'hover:bg-amber-600'
        );

        document.getElementById('kategoriNama').value = nama;

        document.getElementById('formKategori').action =
            '/admin/kategori/' + id;

        document.getElementById('methodContainerKategori').innerHTML =
            '<input type="hidden" name="_method" value="PUT">';
    }

    function closeKategoriModal() {

        document.getElementById('modalKategori').classList.add('hidden');
        document.getElementById('modalKategori').classList.remove('flex');

    }

    /* FILTER */
    document.getElementById('btnFilter')
        .addEventListener('click', function () {

            let kategori =
                document.getElementById('filterKategori').value;

            document.querySelectorAll('.card')
                .forEach(card => {

                    if (kategori === '') {

                        card.style.display = 'block';
                        return;

                    }

                    if (card.dataset.id == kategori) {

                        card.style.display = 'block';

                    } else {

                        card.style.display = 'none';

                    }

                });

        });

    /* RESET */
    document.getElementById('resetFilter')
        .addEventListener('click', function () {

            document.getElementById('filterKategori').value = '';

            document.querySelectorAll('.card')
                .forEach(card => {

                    card.style.display = 'block';

                });

        });
</script>

@endsection
