@extends('layouts.auth')

@section('title', 'GudangPro | Login')

@section('content')

<section class="flex-1 px-6 py-10 flex items-center">

    <div class="max-w-7xl mx-auto w-full bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2 min-h-[650px]">

        <!-- FORM -->
        <div class="p-8 lg:p-12 flex flex-col justify-center">

            <div class="mb-8">
                <h2 class="text-5xl font-extrabold text-slate-800 mb-3">
                    {{ __('app.selamat_datang') }}
                </h2>
                <p class="text-gray-500 text-lg">
                    {{ __('app.login_subtitle') }}
                </p>
            </div>

            {{-- ERROR --}}
            @if(session('error'))
            <div class="mb-5 bg-red-100 border border-red-200 text-red-600 px-4 py-3 rounded-2xl text-sm">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                <!-- USERNAME -->
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">
                        {{ __('app.username') }}
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            placeholder="{{ __('app.masukkan_username') }}"
                            class="w-full border border-gray-200 rounded-2xl pl-14 pr-5 py-4 bg-gray-50
                            focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                            placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                    </div>
                    @error('username')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">
                        {{ __('app.kata_sandi') }}
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="password" name="password" required
                            placeholder="{{ __('app.masukkan_password') }}"
                            class="w-full border border-gray-200 rounded-2xl pl-14 pr-14 py-4 bg-gray-50
                            focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                            placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- INFO LUPA KATA SANDI --}}
                <p class="text-xs text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ __('app.lupa_sandi') }}
                </p>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full py-4 rounded-2xl bg-blue-700 hover:bg-blue-800
                    text-white text-lg font-semibold transition duration-300">
                    {{ __('app.masuk') }}
                </button>

            </form>

        </div>

        <!-- IMAGE -->
        <div class="hidden lg:flex bg-gradient-to-br from-[#eef4ff] to-[#dfeaff] items-center justify-center relative">
            <img src="{{ asset('images/logingudang.png') }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-white/10"></div>
        </div>

    </div>

</section>

@endsection