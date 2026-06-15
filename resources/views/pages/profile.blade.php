@extends('layouts.app')

@section('title', 'Profil')

@section('content')

    @php
        $initials = collect(explode(' ', $user->name))
            ->map(fn($w) => strtoupper($w[0]))
            ->take(2)
            ->join('');
        $colors = [
            'from-blue-500 to-blue-600',
            'from-purple-500 to-purple-600',
            'from-green-500 to-green-600',
            'from-rose-500 to-rose-600',
        ];
        $color = $colors[ord($user->name[0]) % count($colors)];
    @endphp

    <div class="w-full">
        <div class="flex flex-col md:flex-row gap-5 items-start">

            {{-- === KIRI (sticky) === --}}
            <div class="w-full md:w-72 flex-shrink-0 md:sticky md:top-24 space-y-4">

                {{-- CARD PROFIL --}}
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="h-16 bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    <div class="px-5 pb-5">
                        <div class="-mt-8 mb-4 flex justify-center">
                            <div
                                class="w-16 h-16 rounded-xl bg-gradient-to-br {{ $color }}
                            flex items-center justify-center shadow-lg border-4 border-white">
                                <span class="text-white font-bold text-xl">{{ $initials }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-bold text-slate-800 text-base">{{ $user->name }}</h3>
                            <p class="text-slate-400 text-xs mt-0.5 truncate">{{ $user->email }}</p>
                            <span
                                class="inline-flex items-center gap-1 mt-2 px-3 py-1 rounded-full
                            bg-blue-100 text-blue-700 text-xs font-semibold capitalize">
                                <i class="fas fa-shield-alt text-xs"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-at text-slate-400 w-4 text-center text-xs"></i>
                                <span class="text-slate-500 text-xs">{{ $user->username }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-circle text-green-500 w-4 text-center text-[8px]"></i>
                                <span class="text-slate-500 text-xs">Akun Aktif</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-id-badge text-slate-400 w-4 text-center text-xs"></i>
                                <span class="text-slate-500 text-xs">ID: {{ $user->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TIPS KEAMANAN --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-shield-alt text-blue-600 text-sm"></i>
                        <p class="text-sm font-semibold text-blue-700">Tips Keamanan</p>
                    </div>
                    <ul class="space-y-2">
                        @foreach (['Gunakan password minimal 8 karakter', 'Kombinasikan huruf, angka, dan simbol', 'Jangan bagikan password ke siapapun', 'Ganti password secara berkala'] as $tip)
                            <li class="flex items-start gap-2 text-xs text-blue-600">
                                <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>{{ $tip }}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            {{-- === KANAN === --}}
            <div class="flex-1 space-y-4">

                {{-- FORM INFO PROFIL --}}
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                    {{-- HEADER --}}
                    <div class="px-6 py-5 bg-slate-50 border-b border-slate-200">
                        <h3 class="text-xl font-semibold text-slate-800">Informasi Profil</h3>
                        <p class="text-sm text-slate-500 mt-1">Perbarui nama dan email akun Anda.</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-5">

                                {{-- NAMA --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                        placeholder="Nama lengkap"
                                        class="w-full px-4 py-3 border rounded-lg text-sm outline-none
                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                    {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                    @error('name')
                                        <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- USERNAME --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
                                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                        required placeholder="Username"
                                        class="w-full px-4 py-3 border rounded-lg text-sm outline-none
                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                    {{ $errors->has('username') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                    @error('username')
                                        <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- EMAIL --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Alamat Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                        placeholder="email@contoh.com"
                                        class="w-full px-4 py-3 border rounded-lg text-sm outline-none
                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                    {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                    @error('email')
                                        <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- ROLE (readonly) --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Role
                                        <span class="text-slate-400 font-normal text-xs">(tidak dapat diubah)</span>
                                    </label>
                                    <div
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200
                                    rounded-lg text-sm text-slate-500 capitalize cursor-not-allowed flex items-center gap-2">
                                        <i class="fas fa-shield-alt text-slate-400 text-xs"></i>
                                        {{ ucfirst($user->role) }}
                                    </div>
                                </div>

                            </div>

                            {{-- FOOTER --}}
                            <div class="mt-6 pt-5 border-t border-slate-200 flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
                                rounded-lg shadow-sm transition flex items-center gap-2">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                {{-- FORM GANTI PASSWORD --}}
                <div id="password" class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    {{-- HEADER --}}
                    <div class="px-6 py-5 bg-slate-50 border-b border-slate-200">
                        <h3 class="text-xl font-semibold text-slate-800">Ganti Password</h3>
                        <p class="text-sm text-slate-500 mt-1">Pastikan password baru minimal 8 karakter.</p>
                    </div>

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-5">

                                {{-- PASSWORD LAMA --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Saat Ini</label>
                                    <div class="relative">
                                        <input type="password" name="password_lama" id="passwordLama" required
                                            placeholder="Masukkan password saat ini"
                                            class="w-full px-4 pr-12 py-3 border rounded-lg text-sm outline-none
                                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                        {{ $errors->has('password_lama') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                        <button type="button" onclick="togglePassword('passwordLama','eyeLama')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                                            <i id="eyeLama" class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                    @error('password_lama')
                                        <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- PASSWORD BARU --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password_baru" id="passwordBaru" required
                                            placeholder="Minimal 8 karakter"
                                            class="w-full px-4 pr-12 py-3 border rounded-lg text-sm outline-none
                                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                        {{ $errors->has('password_baru') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                        <button type="button" onclick="togglePassword('passwordBaru','eyeBaru')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                                            <i id="eyeBaru" class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                    {{-- Strength bar --}}
                                    <div id="strengthBar" class="hidden mt-2">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                                <div id="strengthFill"
                                                    class="h-full rounded-full transition-all duration-300 w-0"></div>
                                            </div>
                                            <span id="strengthText" class="text-xs font-medium w-14 text-right"></span>
                                        </div>
                                    </div>
                                    @error('password_baru')
                                        <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- KONFIRMASI --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password
                                        Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password_baru_confirmation" id="passwordKonfirm"
                                            required placeholder="Ulangi password baru"
                                            class="w-full px-4 pr-12 py-3 border border-slate-300 rounded-lg text-sm
                                        outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        <button type="button" onclick="togglePassword('passwordKonfirm','eyeKonfirm')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                                            <i id="eyeKonfirm" class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            {{-- FOOTER --}}
                            <div class="mt-6 pt-5 border-t border-slate-200 flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium
                                rounded-lg shadow-sm transition flex items-center gap-2">
                                    <i class="fas fa-key"></i> Ganti Password
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

@endsection
