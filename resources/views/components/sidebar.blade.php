<!-- SIDEBAR -->
<aside class="w-72 bg-slate-900 text-white p-6 shadow-xl
      fixed top-0 left-0 h-screen overflow-hidden">

    <!-- LOGO -->
    <div class="pb-6 mb-6 border-b border-slate-700/60">
        <div class="flex items-center gap-2">

            <img src="{{ asset('images/LogoG.png') }}" alt="GudangPro"
                class="w-14 h-14 object-contain">

            <h1 class="text-white text-2xl font-bold">
                GudangPro
            </h1>

        </div>
    </div>

    <!-- MENU -->
    <nav class="space-y-2 text-sm">

        <!-- DASHBOARD -->
        <a href="/dashboard"
           class="flex items-center gap-3 px-4 py-3 rounded-xl
           {{ request()->is('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <!-- DATA BARANG -->
        <a href="/data-barang"
           class="flex items-center gap-3 px-4 py-3 rounded-xl
           {{ request()->is('data-barang') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
            <i class="fas fa-box"></i> Data Barang
        </a>

        <!-- 🔥 KATEGORI (SUDAH FIX) -->
        <a href="/kategori"
           class="flex items-center gap-3 px-4 py-3 rounded-xl
           {{ request()->is('kategori') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
            <i class="fas fa-folder"></i> Kategori
        </a>

        <!-- SUPPLIER -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
            <i class="fas fa-truck"></i> Supplier
        </a>

        <!-- BARANG MASUK -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
            <i class="fas fa-arrow-down"></i> Barang Masuk
        </a>

        <!-- BARANG KELUAR -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
            <i class="fas fa-arrow-up"></i> Barang Keluar
        </a>

        <!-- LAPORAN -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
            <i class="fas fa-file-alt"></i> Laporan
        </a>

        <!-- LOGOUT -->
        <a href="/logout"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/20 mt-6">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

    </nav>

</aside>