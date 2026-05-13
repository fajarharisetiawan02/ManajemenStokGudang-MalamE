@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
@php
    $brandOptions = ['Honda', 'Toyota', 'Daihatsu', 'Suzuki'];
@endphp

<div class="w-full space-y-4">

    <!-- FILTER CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-4 flex flex-wrap items-center gap-3 w-full">
            <form method="GET" action="{{ url('/data-barang') }}" class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari barang..."
                        class="pl-9 pr-4 py-2.5 w-64 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <select
                    name="brand"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Semua Brand</option>
                    @foreach($brandOptions as $brand)
                        <option value="{{ $brand }}" {{ request('brand') === $brand ? 'selected' : '' }}>
                            {{ $brand }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ url('/data-barang') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Reset
                </a>
            </form>

            <div class="ml-auto">
                <button
                    type="button"
                    data-modal-target="modalTambah"
                    data-modal-toggle="modalTambah"
                    onclick="setModeTambah()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition"
                >
                    <i class="fas fa-plus"></i>
                    Tambah Barang
                </button>
            </div>
        </div>
    </div>

<!-- TABLE CARD -->
<div class="w-full bg-white border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full min-w-[1100px] text-[15px]">

            <!-- HEADER -->
            <thead class="bg-blue-600 text-white text-[13px] uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-4 text-left font-semibold">No</th>
                    <th class="px-4 py-4 text-left font-semibold">No Part</th>
                    <th class="px-4 py-4 text-left font-semibold">Nama</th>
                    <th class="px-4 py-4 text-left font-semibold">Kategori</th>
                    <th class="px-4 py-4 text-left font-semibold">Brand</th>
                    <th class="px-4 py-4 text-center font-semibold">Stok</th>
                    <th class="px-4 py-4 text-left font-semibold">Harga</th>
                    <th class="px-4 py-4 text-left font-semibold">Supplier</th>
                    <th class="px-4 py-4 text-center font-semibold">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($barang as $item)
                    @php
                        $stok = (int) $item->stok;

                        if ($stok <= 0) {
                            $stokClass = 'text-red-600 bg-red-50 border-red-100';
                            $stokText = 'Habis';
                        } elseif ($stok <= 5) {
                            $stokClass = 'text-amber-700 bg-amber-50 border-amber-100';
                            $stokText = 'Menipis';
                        } else {
                            $stokClass = 'text-emerald-700 bg-emerald-50 border-emerald-100';
                            $stokText = 'Aman';
                        }
                    @endphp

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4 text-gray-500 text-[15px]">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-4 font-mono text-sm text-gray-700">
                            {{ $item->no_part }}
                        </td>

                        <td class="px-4 py-4 font-semibold text-gray-800 text-[15px]">
                            {{ $item->nama_barang }}
                        </td>

                        <td class="px-4 py-4 text-gray-600 text-[15px]">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $item->brand }}
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <span class="inline-flex flex-col items-center px-3 py-2 rounded-lg border {{ $stokClass }}">
                                <span class="font-semibold text-[15px] leading-none">
                                    {{ $item->stok }}
                                </span>

                                <span class="text-[12px] leading-none mt-1">
                                    {{ $stokText }}
                                </span>
                            </span>
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-[15px]">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-4 text-gray-600 text-[15px]">
                            {{ $item->supplier->nama_supplier ?? '-' }}
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-2">
                                <button
                                    type="button"
                                    data-id="{{ $item->id }}"
                                    data-no-part="{{ $item->no_part }}"
                                    data-nama-barang="{{ $item->nama_barang }}"
                                    data-kategori-id="{{ $item->kategori_id ?? '' }}"
                                    data-brand="{{ $item->brand }}"
                                    data-stok="{{ $item->stok }}"
                                    data-harga="{{ $item->harga }}"
                                    data-supplier-id="{{ $item->supplier_id ?? '' }}"
                                    onclick="editData(this)"
                                    class="w-9 h-9 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-100 transition flex items-center justify-center"
                                >
                                    <i class="fas fa-pen text-xs"></i>
                                </button>

                                <form action="{{ route('admin.data-barang.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        onclick="confirmDelete(this.form)"
                                        class="w-9 h-9 rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition flex items-center justify-center"
                                    >
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-14">
                            <div class="flex flex-col items-center text-center text-gray-500">
                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-box-open text-2xl text-gray-400"></i>
                                </div>

                                <p class="font-medium text-gray-700 text-[15px]">
                                    Belum ada data barang
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    Klik “Tambah Barang” untuk mulai input data.
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        <!-- TABLE FOOTER -->
        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200 bg-white">
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <span>Page</span>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <div class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700">
                        1
                    </div>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>

                <span>of 1</span>

                <div class="flex items-center gap-2">
                    <span>View</span>
                    <select class="h-9 w-[90px] px-3 pr-8 border border-gray-300 bg-white text-sm focus:outline-none rounded-md">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                    <span>records</span>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                Found total {{ count($barang) }} records
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="modalTambah" tabindex="-1"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex items-start justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Tambah Barang Baru</h2>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data barang di bawah ini.</p>
            </div>
            <button type="button" data-modal-hide="modalTambah" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('admin.data-barang.store') }}" class="p-6">
            @csrf

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">No Part</label>
                    <input type="text" name="no_part" required placeholder="Contoh: BRG-001"
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" required placeholder="Nama Barang"
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori_id" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Brand</label>
                    <select name="brand" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Brand</option>
                        @foreach($brandOptions as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stok" required min="0" placeholder="0"
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" required min="0" placeholder="Contoh: 100000"
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Supplier</label>
                    <select name="supplier_id" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Supplier</option>
                        @foreach($supplier as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-gray-200">
                <button type="button" data-modal-hide="modalTambah"
                    class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition shadow-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" tabindex="-1"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex items-start justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Edit Barang</h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui data barang di bawah ini.</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="formEditBarang" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">No Part</label>
                    <input id="edit_no_part" type="text" name="no_part" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Barang</label>
                    <input id="edit_nama_barang" type="text" name="nama_barang" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Kategori</label>
                    <select id="edit_kategori_id" name="kategori_id" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Brand</label>
                    <select id="edit_brand" name="brand" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Brand</option>
                        @foreach($brandOptions as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Stok</label>
                    <input id="edit_stok" type="number" name="stok" required min="0"
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Harga</label>
                    <input id="edit_harga" type="number" name="harga" required min="0"
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Supplier</label>
                    <select id="edit_supplier_id" name="supplier_id" required
                        class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Supplier</option>
                        @foreach($supplier as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-gray-200">
                <button type="button" onclick="closeEditModal()"
                    class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition shadow-sm">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function setModeTambah() {
        const modal = document.getElementById('modalTambah');
        const form = modal.querySelector('form');

        form.reset();
        form.action = @json(route('admin.data-barang.store'));

        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

        const title = modal.querySelector('h2');
        if (title) title.innerText = 'Tambah Barang Baru';

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.innerText = 'Simpan';
    }

    function editData(button) {
        const modal = document.getElementById('modalEdit');
        const form = document.getElementById('formEditBarang');

        form.action = `{{ url('/admin/data-barang') }}/${button.dataset.id}`;

        document.getElementById('edit_no_part').value = button.dataset.noPart || '';
        document.getElementById('edit_nama_barang').value = button.dataset.namaBarang || '';
        document.getElementById('edit_kategori_id').value = button.dataset.kategoriId || '';
        document.getElementById('edit_brand').value = button.dataset.brand || '';
        document.getElementById('edit_stok').value = button.dataset.stok || 0;
        document.getElementById('edit_harga').value = button.dataset.harga || 0;
        document.getElementById('edit_supplier_id').value = button.dataset.supplierId || '';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

@endsection