@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<!-- ================= FORM ================= -->
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 mb-6">

    <div class="flex items-center gap-2 mb-4">
        <h3 class="text-md font-semibold text-gray-700">
            Form Barang Keluar
        </h3>
    </div>

    <form action="{{ route('admin.barang-keluar.store') }}" method="POST">
        @csrf
        <input type="hidden" name="edit_index" id="edit_index">

        <div class="grid md:grid-cols-2 gap-4">

            <div>
                <label class="text-sm font-semibold text-gray-600">Tanggal Keluar</label>
                <input type="date" name="tanggal"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg mt-1 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-600">Kode Barang</label>
                <div class="flex gap-2 mt-1">
                    <input type="text" name="kode" placeholder="Input kode"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

                    <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 rounded-lg flex items-center justify-center">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-600">Nama Barang</label>
                <input type="text" name="nama" placeholder="Nama barang"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg mt-1 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-600">Jumlah Keluar</label>
                <input type="number" name="jumlah" placeholder="Kurangkan jumlah"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg mt-1 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="md:col-span-2">
                <label class="text-sm font-semibold text-gray-600">Tujuan</label>
                <input type="text" name="tujuan" placeholder="Tujuan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg mt-1 focus:ring-2 focus:ring-blue-500">
            </div>

        </div>

        <div class="flex gap-3 mt-5">
            <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded-lg">
                Simpan
            </button>

            <button type="reset" class="bg-gray-400 text-white px-5 py-2 rounded-lg" onclick="resetForm()">
                Reset
            </button>
        </div>

    </form>

</div>

<!-- ================= TABLE ================= -->
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <div class="flex flex-wrap gap-2 mb-4">
        <input type="text" placeholder="Cari kode atau nama barang..."
            class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

        <button class="bg-green-600 text-white px-4 rounded-lg">
            Export
        </button>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm">

            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Kode</th>
                    <th class="px-4 py-3 text-left">Nama Barang</th>
                    <th class="px-4 py-3 text-center">Jumlah</th>
                    <th class="px-4 py-3 text-left">Tujuan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @if(empty($data))
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">
                        Belum ada data barang keluar
                    </td>
                </tr>
                @else

                @foreach($data as $i => $item)
                <tr class="border-b">

                    <td class="px-4 py-3 text-center">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">{{ $item['tanggal'] }}</td>
                    <td class="px-4 py-3">{{ $item['kode'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $item['nama'] }}</td>
                    <td class="px-4 py-3 text-center text-red-600 font-semibold">{{ $item['jumlah'] }}</td>
                    <td class="px-4 py-3">{{ $item['tujuan'] }}</td>

                    <td class="flex gap-2 justify-center p-2">
                        <button type="button" onclick="editData(this, {{ $i }})"
                            class="bg-yellow-400 hover:bg-yellow-500 px-2 py-1 rounded">
                            <i class="fas fa-pen text-xs"></i>
                        </button>

                        <button onclick="hapusData(this)"
                            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </td>

                </tr>
                @endforeach

                @endif
            </tbody>

        </table>
    </div>

</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    lucide.createIcons();

    document.addEventListener('DOMContentLoaded', function () {

        window.editData = function (button, index) {

            let row = button.closest('tr');
            let cells = row.querySelectorAll('td');

            let tanggal = cells[1].innerText.trim();
            let kode = cells[2].innerText.trim();
            let nama = cells[3].innerText.trim();
            let jumlah = cells[4].innerText.trim();
            let tujuan = cells[5].innerText.trim();

            const tglInput = document.querySelector('[name="tanggal"]');
            const kodeInput = document.querySelector('[name="kode"]');
            const namaInput = document.querySelector('[name="nama"]');
            const jumlahInput = document.querySelector('[name="jumlah"]');
            const tujuanInput = document.querySelector('[name="tujuan"]');

            if (!tglInput) return;

            tglInput.value = formatTanggal(tanggal);
            kodeInput.value = kode;
            namaInput.value = nama;
            jumlahInput.value = jumlah;
            tujuanInput.value = tujuan;

            document.getElementById('edit_index').value = index;

            document.querySelector('button[type="submit"]').innerText = "Update Data";

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

    });

    function formatTanggal(tgl) {
        if (tgl.includes('-')) return tgl;
        let p = tgl.split('/');
        return p[2] + '-' + p[1] + '-' + p[0];
    }

    function hapusData(button) {
        let row = button.closest('tr');

        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                row.remove();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus',
                    confirmButtonColor: '#2563eb'
                });
            }
        });
    }
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2563eb'
    });
</script>
@endif

@endsection