<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GudangPro | Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 font-sans">

    <div>
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

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-300">
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

        <!-- Main -->
        <main class="ml-72 flex flex-col flex-1">

             @include('components.navbar')

            <div class="p-10 flex-1 overflow-y-auto">
                <div
                    class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-3xl p-8 shadow-xl mb-10 flex items-center justify-between relative overflow-hidden">

                    <!-- TEXT -->
                    <div class="text-white max-w-lg z-20">
                        <h1 class="text-4xl font-bold mb-2">
                            Halo! 👋
                        </h1>

                        <h2 class="text-2xl font-semibold text-white/95">
                            {{ Auth::user()->name ?? 'Admin GudangPro' }}
                        </h2>

                        <p class="mt-3 text-base text-white/90 leading-relaxed max-w-md">
                            Pantau stok barang, transaksi masuk & keluar, serta aktivitas gudang secara real-time dengan
                            GudangPro.
                        </p>
                    </div>

                    <!-- IMAGE (FIXED) -->
                    <img src="{{ asset('images/LogoDashboard.png') }}"
                        class="hidden md:block absolute right-6 bottom-0 w-60 md:w-72 lg:w-80 object-contain z-10">
                </div>

                <!-- Statistik -->
                <div class="grid md:grid-cols-4 gap-6 mb-10">

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="flex justify-between">
                            <p class="text-slate-500">Total Barang</p>
                            <div class="bg-blue-100 p-3 rounded-xl">
                                <i class="fas fa-box text-blue-600"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-blue-600 mt-4">1,250</h3>
                        <p class="text-green-500 text-sm mt-1">+12% bulan ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="flex justify-between">
                            <p class="text-slate-500">Barang Masuk</p>
                            <div class="bg-green-100 p-3 rounded-xl">
                                <i class="fas fa-arrow-down text-green-600"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-green-600 mt-4">45</h3>
                        <p class="text-green-500 text-sm mt-1">Hari ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="flex justify-between">
                            <p class="text-slate-500">Barang Keluar</p>
                            <div class="bg-red-100 p-3 rounded-xl">
                                <i class="fas fa-arrow-up text-red-600"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-red-600 mt-4">20</h3>
                        <p class="text-red-500 text-sm mt-1">Hari ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="flex justify-between">
                            <p class="text-slate-500">Supplier</p>
                            <div class="bg-purple-100 p-3 rounded-xl">
                                <i class="fas fa-truck text-purple-600"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-purple-600 mt-4">18</h3>
                        <p class="text-slate-400 text-sm mt-1">Aktif</p>
                    </div>

                </div>

                <!-- Chart -->
                <div class="bg-white rounded-2xl shadow p-6 mb-10 h-[350px] w-full">
                    <h3 class="font-bold text-lg mb-4">
                        <i class="fas fa-chart-area text-blue-600 mr-2"></i>
                        Pergerakan Stok
                    </h3>
                    <canvas id="stokChart" class="w-full h-full"></canvas>
                </div>

                <!-- Table & Alert -->
                <div class="grid lg:grid-cols-3 gap-6 mb-10">

                    <!-- Table -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

                        <div class="flex justify-between mb-4">
                            <h3 class="font-bold text-lg">
                                <i class="fas fa-table text-green-600 mr-2"></i>
                                Transaksi Terbaru
                            </h3>
                            <button class="text-blue-600 text-sm hover:underline">Lihat Semua</button>
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

                                <tr class="border-b hover:bg-blue-50 transition">
                                    <td class="py-3">21 Apr</td>
                                    <td>Oli Mesin</td>
                                    <td>20</td>
                                    <td><span
                                            class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">Masuk</span>
                                    </td>
                                </tr>

                                <tr class="border-b hover:bg-blue-50 transition">
                                    <td class="py-3">21 Apr</td>
                                    <td>Kampas Rem</td>
                                    <td>5</td>
                                    <td><span
                                            class="bg-red-100 text-red-600 px-2 py-1 rounded-lg text-xs font-semibold">Keluar</span>
                                    </td>
                                </tr>

                                <tr class="hover:bg-blue-50 transition">
                                    <td class="py-3">20 Apr</td>
                                    <td>Aki Mobil</td>
                                    <td>8</td>
                                    <td><span
                                            class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">Masuk</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- Alert -->
                    <div class="bg-white rounded-2xl shadow p-6">
                        <h3 class="font-bold text-lg mb-4">
                            <i class="fas fa-triangle-exclamation text-red-500 mr-2"></i>
                            Stok Menipis
                        </h3>

                        <div class="space-y-3">
                            <div class="bg-red-50 border border-red-100 text-red-500 p-3 rounded-xl">⚠ Filter Udara
                                - 2 pcs</div>
                            <div class="bg-yellow-50 border border-yellow-100 text-yellow-600 p-3 rounded-xl">⚠ Busi
                                - 4 pcs</div>
                            <div class="bg-red-50 border border-red-100 text-red-500 p-3 rounded-xl">⚠ Lampu Depan -
                                1 pcs</div>
                        </div>
                    </div>

                </div>

                <!-- Quick Action -->
                <div class="bg-white rounded-2xl shadow p-6 mb-10">
                    <h3 class="font-bold text-lg mb-5">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                        Quick Action
                    </h3>

                    <div class="flex gap-4 flex-wrap">
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow hover:shadow-lg active:scale-95 transition">
                            <i class="fas fa-plus mr-2"></i> Barang
                        </button>

                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow hover:shadow-lg active:scale-95 transition">
                            <i class="fas fa-arrow-down mr-2"></i> Masuk
                        </button>

                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow hover:shadow-lg active:scale-95 transition">
                            <i class="fas fa-arrow-up mr-2"></i> Keluar
                        </button>
                    </div>
                </div>
            </div>
            <footer class="pb-4">

                <div class="w-full bg-white border-t border-gray-200 px-6 py-4">

                    <div class="flex items-center justify-between">

                        <!-- KIRI -->
                        <div class="flex items-center gap-3 px-4 py-2 
                        border border-gray-200 bg-gray-50">

                            <div class="w-8 h-5 overflow-hidden border">
                                <div class="h-1/2 bg-red-600"></div>
                                <div class="h-1/2 bg-white"></div>
                            </div>

                            <span class="text-sm font-medium text-gray-700">
                                Indonesia
                            </span>

                        </div>

                        <!-- KANAN -->
                        <div class="text-sm text-gray-500">
                            © 2026 <span class="font-semibold text-gray-700">GudangPro</span> Copyright
                        </div>

                    </div>

                </div>

            </footer>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('stokChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                        label: 'Masuk',
                        data: [10, 15, 20, 30, 25, 35, 40],
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37,99,235,0.08)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Keluar',
                        data: [5, 10, 12, 20, 18, 22, 30],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239,68,68,0.08)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // 🔥 WAJIB BIAR FULL
                layout: {
                    padding: 0 // 🔥 HILANGKAN RUANG KOSONG
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                animation: {
                    duration: 1200,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>