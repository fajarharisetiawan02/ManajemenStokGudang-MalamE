 <!-- SIDEBAR -->
        <aside class="w-72 bg-slate-900 text-white p-6 shadow-xl
              fixed top-0 left-0 h-screen overflow-hidden">

            <div class="pb-6 mb-6 border-b border-slate-700/60">
                <div class="flex items-center gap-4">

                    <!-- LOGO -->
                    <div class="pb-6 mb-6 border-b border-slate-700/60">
                        <div class="flex items-center gap-1">

                            <img src="{{ asset('images/LogoG.png') }}" alt="GudangPro"
                                class="w-16 h-16 object-contain drop-shadow-md">

                            <!-- TEXT -->
                            <h1 class="text-white text-3xl font-bold leading-none">
                                GudangPro
                            </h1>

                        </div>
                    </div>
                </div>

                <!-- Menu -->
                <nav class="space-y-2 text-sm">

                    <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>

                    <a href="/data-barang" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
                        <i class="fas fa-box"></i> Data Barang
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
                        <i class="fas fa-folder"></i> Kategori
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
                        <i class="fas fa-truck"></i> Supplier
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
                        <i class="fas fa-arrow-down"></i> Barang Masuk
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
                        <i class="fas fa-arrow-up"></i> Barang Keluar
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
                        <i class="fas fa-file-alt"></i> Laporan
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/20 mt-6">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                </nav>
        </aside>