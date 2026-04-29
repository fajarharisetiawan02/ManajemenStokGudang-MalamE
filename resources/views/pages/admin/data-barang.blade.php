@extends('layouts.app')

@section('title', 'Data Barang')

@section('icon')
<i class="fas fa-box text-blue-600"></i>
@endsection

@section('content')

<!-- FILTER + BUTTON -->
<form method="GET" action="/data-barang" id="filterForm" class="flex flex-wrap justify-between items-center gap-4 mb-6">

    <div class="flex flex-wrap items-center gap-3">

        <!-- SEARCH -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
            onkeyup="autoSubmit()"
            class="px-4 py-2 border rounded-xl w-64 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

        <!-- BRAND -->
        <select name="brand" onchange="autoSubmit()"
            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Brand</option>
            <option {{ request('brand')=='Honda'?'selected':'' }}>Honda</option>
            <option {{ request('brand')=='Toyota'?'selected':'' }}>Toyota</option>
            <option {{ request('brand')=='Daihatsu'?'selected':'' }}>Daihatsu</option>
            <option {{ request('brand')=='Suzuki'?'selected':'' }}>Suzuki</option>
            <option {{ request('brand')=='Mitsubishi'?'selected':'' }}>Mitsubishi</option>
        </select>

        <!-- SUPPLIER -->
        <select name="supplier" onchange="autoSubmit()"
            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Supplier</option>
            <option {{ request('supplier')=='PT Astra'?'selected':'' }}>PT Astra</option>
            <option {{ request('supplier')=='PT Bridgestone'?'selected':'' }}>PT Bridgestone</option>
            <option {{ request('supplier')=='PT Denso'?'selected':'' }}>PT Denso</option>
        </select>

        <!-- RESET -->
        <a href="/data-barang" class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
            Reset
        </a>

    </div>

    <!-- BUTTON TAMBAH -->
    <button type="button" onclick="openModal()"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md">
        <i class="fas fa-plus mr-2"></i> Tambah Barang
    </button>

</form>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">No Part</th>
                <th class="px-4 py-3 text-left">Nama Barang</th>
                <th class="px-4 py-3 text-left">Kategori</th>
                <th class="px-4 py-3 text-left">Brand</th> <!-- ✅ BARU -->
                <th class="px-4 py-3 text-center">Stok</th>
                <th class="px-4 py-3 text-left">Harga</th>
                <th class="px-4 py-3 text-left">Supplier</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($barang as $item)
            <tr class="border-t hover:bg-blue-50 even:bg-slate-50 transition">

                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-mono text-xs">{{ $item->no_part }}</td>
                <td class="px-4 py-3">{{ $item->nama_barang }}</td>
                <td class="px-4 py-3">{{ $item->kategori->nama_kategori ?? '-' }}</td>

                <td class="px-4 py-3">
                    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-lg text-xs font-semibold">
                        {{ $item->brand ?? '-' }}
                    </span>
                </td>

                <td class="px-4 py-3 text-center">
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">
                        {{ $item->stok }}
                    </span>
                </td>

                <td class="px-4 py-3 font-semibold">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </td>

                <td class="px-4 py-3">
                    {{ $item->supplier->nama_supplier ?? '-' }}
                </td>

                <!-- AKSI -->
                <td class="px-4 py-3">
                    <div class="flex justify-center gap-2">

                        <!-- EDIT -->
                        <button type="button"
                            onclick="editData({{ $item->id }}, '{{ $item->no_part }}', '{{ $item->nama_barang }}', '{{ $item->brand }}', '{{ $item->stok }}', '{{ $item->harga }}')"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white w-9 h-9 flex items-center justify-center rounded-lg transition">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- DELETE -->
                        <form action="{{ route('data-barang.destroy', $item->id) }}" method="POST"
                            id="delete-form-{{ $item->id }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete('delete-form-{{ $item->id }}')"
                                class="bg-red-500 hover:bg-red-600 text-white w-9 h-9 flex items-center justify-center rounded-lg transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- MODAL -->
<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm items-center justify-center z-50 px-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl p-8 animate-fadeIn">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">

            <div class="flex items-center gap-3">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-xl shadow-sm">
                    <i class="fas fa-box"></i>
                </div>

                <div>
                    <h2 id="modalTitle" class="text-xl font-bold text-slate-800">Tambah Barang</h2>
                    <p id="modalSubtitle" class="text-sm text-gray-500">Isi data barang baru</p>
                </div>
            </div>

            <button onclick="closeModal()"
                class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-red-100 text-gray-400 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>

        </div>

        <!-- FORM -->
        <form action="{{ route('data-barang.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- INFORMASI -->
            <div>
                <h3 class="text-sm font-semibold text-slate-500 mb-3">Informasi Barang</h3>

                <div class="space-y-4">
                    <input type="text" name="no_part" placeholder="No Part" required
                        class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <input type="text" name="nama_barang" placeholder="Nama Barang" required
                        class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- KATEGORI -->
            <div>
                <h3 class="text-sm font-semibold text-slate-500 mb-3">Kategori & Brand</h3>

                <div class="grid grid-cols-2 gap-4">

                    <select name="kategori"
                        class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        <option>Oli</option>
                        <option>Ban</option>
                        <option>Filter</option>
                    </select>

                    <select name="brand"
                        class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Brand</option>
                        <option>Honda</option>
                        <option>Toyota</option>
                        <option>Daihatsu</option>
                        <option>Suzuki</option>
                    </select>

                </div>

                <select name="supplier"
                    class="w-full mt-4 px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Supplier</option>
                    <option>PT Astra</option>
                    <option>PT Denso</option>
                    <option>PT Bridgestone</option>
                </select>
            </div>

            <!-- STOK -->
            <div>
                <h3 class="text-sm font-semibold text-slate-500 mb-3">Stok & Harga</h3>

                <div class="grid grid-cols-2 gap-4">

                    <input type="number" name="stok" placeholder="Stok" required
                        class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">

                    <input type="number" name="harga" placeholder="Harga" required
                        class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">

                </div>
            </div>

            <!-- ACTION -->
            <div class="flex justify-end gap-3 pt-4">

                <button type="button" onclick="closeModal()"
                    class="px-5 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>

<script>
    function confirmDelete(formId) {
        console.log("Mencoba menghapus form: " + formId); // Untuk cek di inspect element

        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                } else {
                    console.error("Form dengan ID " + formId + " tidak ditemukan!");
                }
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
        let type = "{{ session('success') }}";
        let msg = "Operasi Berhasil";

        if (type === "tambah") msg = "Data berhasil ditambahkan";
        if (type === "update") msg = "Data berhasil diupdate";
        if (type === "delete") msg = "Data berhasil dihapus";

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: msg
        });
        @endif
    });
</script>

@endsection