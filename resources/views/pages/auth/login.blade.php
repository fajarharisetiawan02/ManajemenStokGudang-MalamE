@extends('layouts.auth')

@section('title', 'GudangPro | Login')

@section('content')

    <!-- CONTENT -->
    <section class="flex-1 px-6 py-10 flex items-center">
        <div
            class="max-w-7xl mx-auto w-full bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2 min-h-[650px]">

            <!-- FORM -->
            <div class="p-8 lg:p-12 flex flex-col justify-center">

                <div class="mb-8">
                    <h2 class="text-5xl font-extrabold text-slate-800 mb-3">
                        Selamat Datang 👋
                    </h2>

                    <p class="text-gray-500 text-lg">
                        Masuk untuk mengelola stok gudang Anda.
                    </p>
                </div>

                @if(session('error'))
                <div class="mb-5 bg-red-100 border border-red-200 text-red-600 px-4 py-3 rounded-2xl text-sm">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="/login" class="space-y-5">
                    @csrf

                    <!-- USERNAME -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 block">
                            Email / Username
                        </label>

                        <input type="text" name="username" required placeholder="Masukkan username"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 block">
                            Kata Sandi
                        </label>

                        <div class="relative">

                            <input type="password" id="password" name="password" required
                                placeholder="Masukkan password"
                                class="w-full border border-gray-200 rounded-2xl px-5 py-4 pr-14 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">

                                <i id="eyeIcon" class="fa-solid fa-eye"></i>

                            </button>

                        </div>
                    </div>

                    <!-- OPTION -->
                    <div class="flex justify-between items-center text-sm text-gray-500">

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded text-blue-600">
                            Remember me
                        </label>

                        <a id="forgotPassword" href="#" class="text-blue-600 hover:underline">
                            Lupa Kata Sandi?
                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold hover:scale-[1.02] hover:shadow-xl transition duration-300">
                        Masuk
                    </button>

                </form>

            </div>

            <!-- IMAGE -->
            <div
                class="hidden lg:flex bg-gradient-to-br from-[#eef4ff] to-[#dfeaff] items-center justify-center relative">

                <img src="{{ asset('images/logingudang.png') }}" class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-white/10"></div>

            </div>

        </div>
    </section>

@endsection