@extends('layouts.app')

@section('title', 'Data Barang')

@section('icon')
<i class="fas fa-box text-blue-600"></i>
@endsection

@section('content')

<!-- FILTER + BUTTON -->
<div class="flex flex-wrap justify-between items-center gap-4 mb-6">

    <!-- LEFT -->
    <div class="flex flex-wrap items-center gap-3">

        <!-- SEARCH -->
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            <input type="text" placeholder="Cari barang..."
                class="pl-10 pr-4 py-2 border rounded-xl w-64 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- FILTER -->
        <select class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
            <option>Semua Kategori</option>
        </select>

        <select class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
            <option>Semua Supplier</option>
        </select>

        <select class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500">
            <option>Semua Stok</option>
        </select>

        <!-- RESET -->
        <button class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
            Reset
        </button>

    </div>

    <!-- BUTTON -->
    <button onclick="openModal()"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md">
        <i class="fas fa-plus mr-2"></i> Tambah Barang
    </button>

</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">No Part</th>
                <th class="px-4 py-3 text-left">Nama Barang</th>
                <th class="px-4 py-3 text-left">Kategori</th>
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

                <td class="px-4 py-3 text-center">
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">
                        {{ $item->stok }}
                    </span>
                </td>

                <td class="px-4 py-3 font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="px-4 py-3">{{ $item->supplier->nama_supplier ?? '-' }}</td>

                <td class="px-4 py-3">
                    <div class="flex justify-center gap-2">
                        <button class="bg-yellow-400 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- MODAL -->
<div id="modalTambah"
    class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 px-4">

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl min-h-[500px] p-10 animate-scaleIn">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Tambah Barang</h2>
                <p class="text-sm text-gray-500">Isi data barang baru</p>
            </div>

            <button onclick="closeModal()"
                class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-red-100 text-gray-400 hover:text-red-500 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- FORM -->
        <form action="/tambah-barang" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-4">

                <div class="relative">
                    <i class="fas fa-barcode absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="no_part" placeholder="No Part"
                        class="w-full pl-12 pr-4 py-3 text-base border rounded-2xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="relative">
                    <i class="fas fa-box absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="nama_barang" placeholder="Nama Barang"
                        class="w-full pl-12 pr-4 py-3 text-base border rounded-2xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="relative">
                    <i class="fas fa-tags absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="kategori" placeholder="Kategori"
                        class="w-full pl-12 pr-4 py-3 text-base border rounded-2xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="relative">
                    <i class="fas fa-truck absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="supplier" placeholder="Supplier"
                        class="w-full pl-12 pr-4 py-3 text-base border rounded-2xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <i class="fas fa-cubes absolute left-4 top-4 text-gray-400"></i>
                        <input type="number" name="stok" placeholder="Stok"
                            class="w-full pl-12 pr-4 py-3 text-base border rounded-2xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="relative">
                        <i class="fas fa-money-bill-wave absolute left-4 top-4 text-gray-400"></i>
                        <input type="number" name="harga" placeholder="Harga"
                            class="w-full pl-12 pr-4 py-3 text-base border rounded-2xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal()"
                    class="px-5 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl shadow-md hover:scale-105 transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalTambah').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalTambah').classList.add('hidden');
}
</script>

@endsection