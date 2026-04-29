@extends('layouts.app')

@section('title', 'Dashboard')

@section('icon')
<i class="fas fa-chart-line text-blue-600"></i>
@endsection

@section('content')

<!-- HERO -->
<div
    class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-3xl p-8 shadow-xl mb-10 flex items-center justify-between relative overflow-hidden">

    <div class="text-white max-w-lg z-20">
        <h1 class="text-4xl font-bold mb-2">
            Halo! 👋
        </h1>

        <h2 class="text-2xl font-semibold text-white/95">
            {{ Auth::user()->name ?? 'Admin GudangPro' }}
        </h2>

        <p class="mt-3 text-base text-white/90 leading-relaxed max-w-md">
            Pantau stok barang, transaksi masuk & keluar, serta aktivitas gudang secara real-time dengan GudangPro.
        </p>
    </div>

    <img src="{{ asset('images/LogoDashboard.png') }}"
        class="hidden md:block absolute right-6 bottom-0 w-60 md:w-72 lg:w-80 object-contain z-10">
</div>

<!-- STATISTIK -->
<div class="grid md:grid-cols-4 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="flex justify-between">
            <p class="text-slate-500">Total Barang</p>
            <div class="bg-blue-100 p-3 rounded-xl">
                <i class="fas fa-box text-blue-600"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-blue-600 mt-4">
            {{ number_format($totalBarang ?? 1250) }}
        </h3>
        <p class="text-green-500 text-sm mt-1">+12% bulan ini</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="flex justify-between">
            <p class="text-slate-500">Barang Masuk</p>
            <div class="bg-green-100 p-3 rounded-xl">
                <i class="fas fa-arrow-down text-green-600"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-green-600 mt-4">
            {{ $barangMasuk ?? 45 }}
        </h3>
        <p class="text-green-500 text-sm mt-1">Hari ini</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="flex justify-between">
            <p class="text-slate-500">Barang Keluar</p>
            <div class="bg-red-100 p-3 rounded-xl">
                <i class="fas fa-arrow-up text-red-600"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-red-600 mt-4">
            {{ $barangKeluar ?? 20 }}
        </h3>
        <p class="text-red-500 text-sm mt-1">Hari ini</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="flex justify-between">
            <p class="text-slate-500">Supplier</p>
            <div class="bg-purple-100 p-3 rounded-xl">
                <i class="fas fa-truck text-purple-600"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-purple-600 mt-4">
            {{ $supplier ?? 18 }}
        </h3>
        <p class="text-slate-400 text-sm mt-1">Aktif</p>
    </div>

</div>
<div class="grid lg:grid-cols-2 gap-6 mb-10">

    <!-- LINE CHART -->
    <div class="bg-white rounded-2xl shadow p-6 h-[400px] flex flex-col">

        <!-- HEADER + FILTER -->
        <div class="flex flex-wrap justify-between items-center mb-4 gap-3">

            <h3 class="font-bold text-lg">
                <i class="fas fa-chart-area text-blue-600 mr-2"></i>
                Pergerakan Stok
            </h3>

            <!-- FILTER TANGGAL -->
            <div class="flex gap-2 items-center">

                <div class="relative">
                    <input id="rangeTanggal"
                        class="pl-3 pr-10 py-1.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilih tanggal">

                    <button type="button" onclick="document.getElementById('rangeTanggal').focus()"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>

                    </button>
                </div>

                <button class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Terapkan
                </button>

            </div>

        </div>

        <!-- CHART -->
        <div class="flex-1">
    <canvas id="stokChart"></canvas>
         </div>

    </div>

    <!-- DONUT CHART -->
    <div class="bg-white rounded-2xl shadow p-6">

        <!-- HEADER + FILTER -->
        <div class="flex flex-wrap justify-between items-center mb-6 gap-3">

            <h3 class="font-bold text-lg">
                <i class="fas fa-chart-pie text-blue-600 mr-2"></i>
                Distribusi Stok per Supplier
            </h3>

            <!-- FILTER TANGGAL -->
            <div class="flex gap-2 items-center">

                <div class="relative">
                    <input id="rangeTanggalDonut"
                        class="pl-3 pr-10 py-1.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilih tanggal">

                    <button type="button" onclick="document.getElementById('rangeTanggalDonut').focus()"
                        class="absolute right-2 top-1/2 -translate-y-1/2 z-10 cursor-pointer text-slate-400 hover:text-blue-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>

                    </button>
                </div>

                <button class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Terapkan
                </button>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="grid grid-cols-2 items-center gap-4">

            <div class="h-[220px]">
                <canvas id="donutGudang"></canvas>
            </div>

            <div id="legendSupplier" class="space-y-2 text-sm"></div>

        </div>

    </div>

</div>
<!-- TABLE & ALERT -->
<div class="grid lg:grid-cols-3 gap-6 mb-10">

    <!-- TABLE -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

        <div class="flex justify-between mb-4">
            <h3 class="font-bold text-lg">
                <i class="fas fa-table text-green-600 mr-2"></i>
                Transaksi Terbaru
            </h3>
            <a href="/transaksi" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
        </div>

        <table class="w-full text-sm">
            <thead class="text-slate-400 uppercase text-xs">
                <tr>
                    <th class="py-3">Tanggal</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @if(isset($transaksi) && count($transaksi) > 0)

                @foreach($transaksi as $item)
                <tr class="border-b hover:bg-blue-50 transition">
                    <td class="py-3">{{ $item->tanggal }}</td>
                    <td>{{ $item->barang }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        @if($item->status == 'Masuk')
                        <span
                            class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">Masuk</span>
                        @else
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded-lg text-xs font-semibold">Keluar</span>
                        @endif
                    </td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td colspan="4" class="text-center py-6 text-slate-400">
                        Tidak ada transaksi
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

    <!-- ALERT -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="font-bold text-lg mb-4">
            <i class="fas fa-triangle-exclamation text-red-500 mr-2"></i>
            Stok Menipis
        </h3>

        @if(isset($stokMenipis) && count($stokMenipis) > 0)

        <div class="space-y-3">
            @foreach($stokMenipis as $item)
            <div class="bg-red-50 border border-red-100 text-red-500 p-3 rounded-xl">
                ⚠ {{ $item->nama }} - {{ $item->stok }} pcs
            </div>
            @endforeach
        </div>

        @else
        <div class="text-slate-400 text-sm">
            Tidak ada stok menipis
        </div>
        @endif

    </div>

</div>

@endsection

@section('script')
@endsection