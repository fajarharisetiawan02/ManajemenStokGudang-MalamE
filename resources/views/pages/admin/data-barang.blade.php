@extends('layouts.app')

@section('title', 'Data Barang')

@section('icon')
<i class="fas fa-box text-blue-600"></i>
@endsection

@section('content')

<!-- ================= FILTER CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4 mb-4">

    <div class="flex flex-wrap justify-between items-center gap-3">

        <!-- FILTER -->
        <form method="GET" action="/data-barang" class="flex gap-3 items-center flex-wrap">

            <!-- SEARCH -->
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="pl-9 pr-4 py-2 border border-gray-300 rounded-xl w-64 shadow-sm 
                    focus:ring-2 focus:ring-blue-500 focus:outline-none"> </div>

            <!-- BRAND -->
            <select name="brand" class="px-4 py-2 border border-gray-300 rounded-xl">
                <option value="">Semua Brand</option>
                <option {{ request('brand')=='Honda'?'selected':'' }}>Honda</option>
                <option {{ request('brand')=='Toyota'?'selected':'' }}>Toyota</option>
                <option {{ request('brand')=='Daihatsu'?'selected':'' }}>Daihatsu</option>
                <option {{ request('brand')=='Suzuki'?'selected':'' }}>Suzuki</option>
            </select>

            <!-- FILTER BTN -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>

            <!-- RESET -->
            <a href="/data-barang" class="px-3 py-2 border rounded-xl text-gray-500 hover:bg-gray-100">
                Reset
            </a>

        </form>

        <!-- TAMBAH -->
<button 
    data-modal-target="modalTambah" 
    data-modal-toggle="modalTambah"
    onclick="setModeTambah()"
    class="relative z-10 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl flex items-center gap-2 shadow">
    <i class="fas fa-plus"></i>
    Tambah Barang
</button>

    </div>

</div>

<!-- ================= TABLE CARD ================= -->
<div class="bg-white rounded-2xl shadow-md border border-gray-100 p-4">

    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-blue-600 text-white text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Part</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Brand</th>
                    <th class="px-4 py-3 text-center">Stok</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                    <th class="px-4 py-3 text-left">Supplier</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @forelse($barang as $item)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3">{{ $loop->iteration }}</td>

                    <td class="px-4 py-3 font-mono text-xs">
                        {{ $item->no_part }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        {{ $item->nama_barang }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $item->kategori->nama_kategori ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-lg text-xs font-semibold">
                            {{ $item->brand }}
                        </span>
                    </td>

                    <!-- STOK -->
                    <td class="px-4 py-3 text-center">
                        @if($item->stok <= 0) <span class="text-red-600 font-bold">{{ $item->stok }}</span>
                            <div class="text-xs text-red-400">Habis</div>
                            @elseif($item->stok <= 5) <span class="text-yellow-500 font-bold">{{ $item->stok }}</span>
                                <div class="text-xs text-yellow-400">Menipis</div>
                                @else
                                <span class="text-green-600 font-bold">{{ $item->stok }}</span>
                                <div class="text-xs text-gray-400">Aman</div>
                                @endif
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $item->supplier->nama_supplier ?? '-' }}
                    </td>

                    <!-- AKSI -->
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2">

                            <button onclick="editData({{ $item->id }})"
                                class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-md hover:bg-yellow-200 flex items-center justify-center">
                                <i class="fas fa-pen text-xs"></i>
                            </button>

                            <form action="{{ route('data-barang.destroy',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this.form)"
                                    class="w-8 h-8 bg-red-100 text-red-600 rounded-md hover:bg-red-200 flex items-center justify-center">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center py-12 text-gray-400">
                        <i class="fas fa-box-open text-3xl mb-2"></i><br>
                        Belum ada data barang
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>
<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah" tabindex="-1"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">

    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-5 py-3 border-b bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-700">
                Tambah Barang Baru
            </h2>

            <button data-modal-hide="modalTambah"
                class="text-gray-400 hover:text-gray-600 text-xl">
                ×
            </button>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('data-barang.store') }}" class="p-6 space-y-5">
            @csrf

            <!-- NO PART -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">No Part</label>
                <input type="text" name="no_part" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                    placeholder="Masukkan No Part">
            </div>

            <!-- NAMA -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Nama Barang</label>
                <input type="text" name="nama_barang" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                    placeholder="Masukkan Nama Barang">
            </div>

            <!-- KATEGORI -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Kategori</label>
                <select name="kategori_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <!-- BRAND -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Brand</label>
                <select name="brand" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                    <option value="">Pilih Brand</option>
                    <option>Honda</option>
                    <option>Toyota</option>
                    <option>Daihatsu</option>
                    <option>Suzuki</option>
                </select>
            </div>

            <!-- STOK -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Stok</label>
                <input type="number" name="stok" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                    placeholder="Masukkan Stok">
            </div>

            <!-- HARGA -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Harga</label>
                <input type="number" name="harga" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                    placeholder="Masukkan Harga">
            </div>

            <!-- SUPPLIER -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Supplier</label>
                <select name="supplier_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                    <option value="">Pilih Supplier</option>
                    @foreach($supplier as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-2 pt-4 border-t">
                <button type="button" data-modal-hide="modalTambah"
                    class="px-4 py-2 bg-gray-200 rounded text-sm hover:bg-gray-300 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 hover:shadow-md transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>
<!-- SCRIPT -->
<script>
    function setModeTambah() {
    const modal = document.getElementById('modalTambah');
    const form = modal.querySelector('form');

    // RESET FORM
    form.reset();

    // SET ACTION KE STORE
    form.action = "{{ route('data-barang.store') }}";

    // HAPUS METHOD PUT (kalau ada dari edit)
    let methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) methodInput.remove();

    // UBAH JUDUL
    modal.querySelector('h2').innerText = "Tambah Barang Baru";

    // UBAH TOMBOL
    form.querySelector('button[type="submit"]').innerText = "Simpan";
}
// DELETE
function confirmDelete(form) {
    Swal.fire({
        title: 'Yakin hapus?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}'
});
</script>
@endif
@endsection