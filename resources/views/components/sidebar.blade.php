@php
    $role = session('role') ?? 'admin';
    $prefix = $role === 'admin' ? 'admin' : 'manager';
@endphp

<aside id="sidebar"
    class="w-72 bg-gradient-to-b from-slate-900 to-slate-950 text-white p-6 shadow-xl
    fixed top-0 left-0 h-screen flex flex-col justify-between z-50
    transform -translate-x-full md:translate-x-0
    transition-transform duration-300">

    <!-- ATAS -->
    <div class="flex flex-col flex-1">

        <!-- LOGO -->
        <div class="pb-6 mb-6 border-b border-slate-700/60">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/LogoG.png') }}" alt="GudangPro" class="w-14 h-14 object-contain">
                <h1 class="text-white text-2xl font-bold">
                    GudangPro
                </h1>
            </div>
        </div>

        <!-- MENU -->
        <nav class="space-y-2 text-base overflow-y-auto flex-1">

            <!-- MAIN -->
            <p class="text-slate-400 text-sm uppercase mb-2 px-3">Main</p>

            <a href="{{ route($prefix.'.dashboard') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is($prefix.'/dashboard') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-chart-line text-lg w-6"></i> 
                <span>Dashboard</span>
            </a>

            <a href="{{ $role === 'admin' ? route('data-barang.index') : route('manager.data-barang') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is($prefix.'/data-barang') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-box text-lg w-6"></i> 
                <span>Data Barang</span>
            </a>

            <!-- MASTER -->
            <p class="text-slate-400 text-sm uppercase mt-6 mb-2 px-3">Master</p>

            @if($role === 'admin')
            <a href="{{ route('kategori.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is('kategori') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-folder text-lg w-6"></i> 
                <span>Kategori</span>   
            </a>
            @endif

            <a href="{{ route('supplier.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is($prefix.'/supplier') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-truck text-lg w-6"></i> 
                <span>Supplier</span>   
            </a>

            <!-- TRANSAKSI -->
            <p class="text-slate-400 text-sm uppercase mt-6 mb-2 px-3">Transaksi</p>

           <a href="{{ route('barang-masuk.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is($prefix.'/barang-masuk') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-arrow-down text-lg w-6"></i> 
                <span>Barang Masuk</span>
            </a>

            <a href="{{ route('barang-keluar.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is($prefix.'/barang-keluar') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-arrow-up text-lg w-6"></i> 
                <span>Barang Keluar</span>
            </a>

            <!-- LAPORAN -->
            <p class="text-slate-400 text-sm uppercase mt-6 mb-2 px-3">Laporan</p>

            <a href="{{ route('laporan.index') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl transition
                {{ request()->is($prefix.'/laporan') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                <i class="fas fa-file-alt text-lg w-6"></i> 
                <span>Laporan</span>
            </a>

        </nav>

    </div>

    <!-- BAWAH -->
    <div class="pt-6 border-t border-slate-700/50">
        <a href="{{ route('logout') }}"
            class="flex items-center gap-4 px-5 py-3 rounded-xl text-red-400 hover:bg-red-500/20 transition">
            <i class="fas fa-sign-out-alt text-lg w-6"></i> 
            <span id="menuLogout">Keluar</span>
        </a>
    </div>

</aside>