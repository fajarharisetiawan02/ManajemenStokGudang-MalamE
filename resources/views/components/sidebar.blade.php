@php
$user = auth()->user();
$role = $user?->role ?? 'admin';
$prefix = $role === 'admin' ? 'admin' : 'manager';
@endphp

<aside id="sidebar" class="w-72 bg-gradient-to-b from-slate-900 to-slate-950 text-white p-6 shadow-xl
    fixed top-0 left-0 h-screen flex flex-col justify-between z-50
    transform -translate-x-full md:translate-x-0
    transition-transform duration-300">

    <div class="flex flex-col flex-1">

        <!-- LOGO -->
        <div class="pb-6 mb-6 border-b border-slate-700/60">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/LogoG.png') }}" class="w-14 h-14">
                <h1 class="text-2xl font-bold">GudangPro</h1>
            </div>
        </div>

        <!-- MENU -->
        <nav class="space-y-2 text-base flex-1 overflow-y-auto">

            <p class="text-slate-500 text-xs uppercase font-semibold tracking-widest px-3 mb-2">{{ __('app.main') }}</p>

            <a href="{{ route($prefix.'.dashboard') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/dashboard') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-home w-6"></i>
                <span>{{ __('app.dashboard') }}</span>
            </a>

            <a href="{{ route($prefix.'.data-barang.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/data-barang*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-box w-6"></i>
                <span>{{ __('app.data_barang') }}</span>
            </a>

            <p class="text-slate-500 text-xs uppercase font-semibold tracking-widest px-3 pt-4 mb-2">{{ __('app.master') }}</p>

            <a href="{{ route($prefix.'.kategori.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/kategori*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-tags w-6"></i>
                <span>{{ __('app.kategori') }}</span>
            </a>

            <a href="{{ route($prefix.'.supplier.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/supplier') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-truck w-6"></i>
                <span>{{ __('app.supplier') }}</span>
            </a>

            <p class="text-slate-500 text-xs uppercase font-semibold tracking-widest px-3 pt-4 mb-2">{{ __('app.transaksi') }}</p>

            <a href="{{ route($prefix.'.barang-masuk.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/barang-masuk') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-arrow-down w-6"></i>
                <span>{{ __('app.barang_masuk') }}</span>
            </a>

            <a href="{{ route($prefix.'.barang-keluar.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/barang-keluar') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-arrow-up w-6"></i>
                <span>{{ __('app.barang_keluar') }}</span>
            </a>

            <p class="text-slate-500 text-xs uppercase font-semibold tracking-widest px-3 pt-4 mb-2">{{ __('app.laporan') }}</p>

            <a href="{{ route($prefix.'.laporan.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-lg transition
                {{ request()->is($prefix.'/laporan') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-file-alt w-6"></i>
                <span>{{ __('app.laporan') }}</span>
            </a>

        </nav>

    </div>

</aside>