@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

@php
$supplierOptions = ['PT Denso', 'PT Astra'];
@endphp

<div class="w-full space-y-4">

    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Barang Masuk</h3>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data barang masuk di bawah ini.</p>
        </div>

        <div class="p-5">
            <form action="{{ route('admin.barang-masuk.store') }}" method="POST">
                @csrf
                <input type="hidden" name="edit_index" id="edit_index">

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" name="tanggal"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Kode Barang</label>
                        <div class="flex gap-2 mt-1">
                            <input type="text" name="kode" placeholder="Input kode"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <button type="button"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-xl flex items-center justify-center transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama" placeholder="Nama barang"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Jumlah Masuk</label>
                        <input type="number" name="jumlah" placeholder="Masukkan jumlah"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier"
                            class="w-full mt-1 px-3 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">Pilih Supplier</option>
                            @foreach($supplierOptions as $supplier)
                            <option value="{{ $supplier }}">{{ $supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 pt-5 mt-5 border-t border-gray-200">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm">
                        Simpan
                    </button>

                    <button type="reset"
                        class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-600 px-5 py-2.5 rounded-xl transition">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex flex-wrap items-center gap-3">
            <input type="text" placeholder="Cari kode atau nama barang..."
                class="flex-1 min-w-[220px] px-4 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">

            <select
                class="px-4 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                <option>Semua Supplier</option>
                @foreach($supplierOptions as $supplier)
                <option>{{ $supplier }}</option>
                @endforeach
            </select>

            <button class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl transition">
                Export
            </button>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1000px] text-[15px]">
                <thead class="bg-blue-600 text-white text-[13px] uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-4 text-center font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-4 text-left font-semibold">Kode</th>
                        <th class="px-4 py-4 text-left font-semibold">Nama Barang</th>
                        <th class="px-4 py-4 text-center font-semibold">Jumlah</th>
                        <th class="px-4 py-4 text-left font-semibold">Supplier</th>
                        <th class="px-4 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($data as $i => $item)
                    <tr class="hover:bg-blue-50/40 transition duration-200">
                        <td class="px-4 py-4 text-center text-gray-500">{{ $i + 1 }}</td>
                        <td class="px-4 py-4 text-gray-700">{{ $item['tanggal'] }}</td>
                        <td class="px-4 py-4 font-mono text-sm text-gray-700">{{ $item['kode'] }}</td>
                        <td class="px-4 py-4 font-semibold text-gray-800">{{ $item['nama'] }}</td>

                        <td class="px-4 py-4 text-center">
                            <span
                                class="inline-flex px-3 py-1 rounded-md bg-blue-50 text-blue-700 border border-blue-100 font-semibold">
                                {{ $item['jumlah'] }}
                            </span>
                        </td>

                        <td class="px-4 py-4 text-gray-600">{{ $item['supplier'] }}</td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-2">
                                <button type="button" onclick="editData(this, {{ $i }})"
                                    class="w-10 h-10 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-100 transition flex items-center justify-center">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>

                                <button type="button" onclick="hapusData(this)"
                                    class="w-10 h-10 rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition flex items-center justify-center">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-14">
                            <div class="flex flex-col items-center text-center text-gray-500">
                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-box-open text-2xl text-gray-400"></i>
                                </div>

                                <p class="font-medium text-gray-700 text-[15px]">
                                    Belum ada data barang masuk
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    Silakan input data barang masuk terlebih dahulu.
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
                    <button
                        class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <div
                        class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700">
                        1
                    </div>
                    <button
                        class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>

                <span>of 1</span>

                <div class="flex items-center gap-2">
                    <span>View</span>
                    <select
                        class="h-9 w-[90px] px-3 pr-8 border border-gray-300 bg-white text-sm focus:outline-none rounded-md">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                    <span>records</span>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                Found total {{ count($data) }} records
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>

<script>
    lucide.createIcons();

    document.addEventListener('DOMContentLoaded', function () {
        window.editData = function (button, index) {
            const row = button.closest('tr');
            const cells = row.querySelectorAll('td');

            document.querySelector('[name="tanggal"]').value = formatTanggal(cells[1].innerText.trim());
            document.querySelector('[name="kode"]').value = cells[2].innerText.trim();
            document.querySelector('[name="nama"]').value = cells[3].innerText.trim();
            document.querySelector('[name="jumlah"]').value = cells[4].innerText.trim();
            document.querySelector('[name="supplier"]').value = cells[5].innerText.trim();

            document.getElementById('edit_index').value = index;

            const submitBtn = document.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.innerText = 'Update Data';

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    });

    function formatTanggal(tgl) {
        if (tgl.includes('-')) return tgl;
        const p = tgl.split('/');
        return p[2] + '-' + p[1] + '-' + p[0];
    }

function hapusData(button) {
    button.closest('tr').remove();

    document.querySelectorAll('tbody tr').forEach((row, index) => {
        row.cells[0].innerText = index + 1;
    });
}
</script>

@endsection