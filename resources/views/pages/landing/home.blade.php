@extends('layouts.landing')

@section('title', 'GudangPro | Home')

@section('content')

@include('components.landing-navbar')
    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-100 via-slate-50 to-blue-50">
        <div class="container mx-auto px-8 py-20 grid md:grid-cols-2 gap-10 items-center min-h-[88vh]">

            <!-- LEFT -->
            <div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mt-5 mb-6 text-slate-900">
                    Kelola Stok Gudang Lebih Mudah & Cepat
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    Pantau barang masuk, barang keluar, stok spare part,
                    supplier, dan laporan gudang secara real-time dengan sistem modern.
                </p>

                <div class="flex gap-4 flex-wrap">

                    <a href="/login"
                        class="bg-blue-700 text-white px-7 py-3 rounded-xl shadow-lg hover:bg-blue-800 transition">
                        🚀 Mulai Sekarang
                    </a>

                    <a href="/contact"
                        class="border border-slate-300 text-slate-700 px-7 py-3 rounded-xl hover:bg-white transition">
                        📞 Hubungi Kami
                    </a>

                </div>

                <!-- STAT -->
                <div class="grid grid-cols-3 gap-4 mt-10">

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700">5000+</h3>
                        <p class="text-sm text-gray-500">Spare Part</p>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700">120+</h3>
                        <p class="text-sm text-gray-500">Supplier</p>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700">99%</h3>
                        <p class="text-sm text-gray-500">Akurasi</p>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative flex justify-center items-center">

                <!-- soft background glow -->
                <div class="absolute w-[520px] h-[520px] bg-slate-200 rounded-full blur-3xl opacity-60"></div>

                <!-- image -->
                <img src="{{ asset('images/gudang.png') }}" alt="Gudang Dashboard" class="relative z-10 w-full max-w-3xl object-contain
                    brightness-105 contrast-95 saturate-90 opacity-95
                    mix-blend-multiply
                    transition duration-500">

            </div>

    </section>

    <!-- KEUNGGULAN -->
    <section class="bg-gradient-to-b from-white to-slate-50 py-24">

        <div class="container mx-auto px-8">

            <!-- TITLE -->
            <div class="text-center mb-16">

                <span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-sm font-semibold shadow-sm">
                    Platform Stok Gudang Terpercaya </span>

                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mt-6">
                    Keunggulan Sistem GudangPro
                </h2>

                <!-- garis bawah -->
                <div class="w-28 h-1 bg-blue-700 mx-auto rounded-full mt-5 mb-6"></div>

                <p class="text-gray-500 max-w-3xl mx-auto text-lg leading-relaxed">
                    Dirancang untuk membantu pengelolaan stok spare part kendaraan
                    menjadi lebih cepat, akurat, efisien, dan modern.
                </p>

            </div>

            <!-- CARD -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-7">

                <!-- CARD 1 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-blue-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-700
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Monitoring Stok
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Pantau barang masuk, keluar, dan jumlah stok secara real-time.
                    </p>

                </div>

                <!-- CARD 2 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-amber-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-amber-100 text-amber-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-bell"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Alert Otomatis
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Sistem memberi notifikasi saat stok spare part hampir habis.
                    </p>

                </div>

                <!-- CARD 3 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Laporan Lengkap
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Data penjualan, stok, supplier, dan transaksi tersusun otomatis.
                    </p>

                </div>

                <!-- CARD 4 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-purple-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-purple-100 text-purple-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Multi User
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Bisa digunakan Admin Gudang dan Manajer bersamaan.
                    </p>

                </div>

            </div>

        </div>

    </section>
    @include('components.landing-footer')
@endsection