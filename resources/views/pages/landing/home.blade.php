@extends('layouts.landing')

@section('title', 'GudangPro | Home')

@section('content')

    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-100 via-slate-50 to-blue-50">
        <div class="container mx-auto px-4 md:px-8 py-12 md:py-20 grid md:grid-cols-2 gap-10 items-center min-h-[88vh]">

            <!-- LEFT -->
            <div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mt-5 mb-6 text-slate-900">
                    {{ __('app.hero_title') }}
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    {{ __('app.hero_subtitle') }}
                </p>

                <!-- STAT -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10">

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700 counter" data-target="{{ $totalBarang }}">0</h3>
                        <p class="text-sm text-gray-500">{{ __('app.spare_part') }}</p>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700 counter" data-target="{{ $totalSupplier }}">0</h3>
                        <p class="text-sm text-gray-500">{{ __('app.supplier') }}</p>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700 counter" data-target="{{ $totalTransaksi }}">0</h3>
                        <p class="text-sm text-gray-500">{{ __('app.total_transaksi') }}</p>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative flex justify-center items-center">

                <!-- soft background glow -->
                <div class="absolute w-[520px] h-[520px] bg-slate-200 rounded-full blur-3xl opacity-60"></div>

                <!-- image -->
                <img src="{{ asset('images/gudang.png') }}" alt="Gudang Dashboard" class="relative z-10 w-full max-w-sm md:max-w-3xl object-contain
                    brightness-105 contrast-95 saturate-90 opacity-95
                    mix-blend-multiply">

            </div>

        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section id="keunggulan" class="bg-gradient-to-b from-white to-slate-50 py-16 md:py-24">

        <div class="container mx-auto px-4 md:px-8">

            <!-- TITLE -->
            <div class="text-center mb-16">

                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900">
                    {{ __('app.keunggulan_title') }}
                </h2>

                <!-- garis bawah -->
                <div class="w-28 h-1 bg-blue-700 mx-auto rounded-full mt-5 mb-6"></div>

                <p class="text-gray-500 max-w-3xl mx-auto text-lg leading-relaxed">
                    {{ __('app.keunggulan_desc') }}
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
                        {{ __('app.monitoring_stok') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ __('app.monitoring_desc') }}
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
                        {{ __('app.alert_otomatis') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ __('app.alert_desc') }}
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
                        {{ __('app.laporan_lengkap') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ __('app.laporan_desc') }}
                    </p>
                </div>

                <!-- CARD 4 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-purple-200
                        transition duration-300">
                    <div class="w-14 h-14 rounded-xl bg-purple-100 text-purple-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        {{ __('app.multi_user') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ __('app.multi_user_desc') }}
                    </p>
                </div>

            </div>

        </div>

    </section>

@endsection

@section('script')
    @vite('resources/js/home.js')
@endsection