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

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside
            class="w-72 bg-gradient-to-b from-slate-900 via-slate-800 to-blue-900 text-white p-6 shadow-2xl border-r border-slate-700">
            <!-- Logo -->
            <div class="mb-10 text-center border-b border-slate-600 pb-6">
                <div class="mb-10 border-b border-slate-600 pb-6">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shadow">
                            <i class="fas fa-warehouse text-blue-700 text-xl"></i>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-white">GudangPro</h1>
                        </div>

                    </div>

                </div>

                <!-- Menu -->
                <nav class="space-y-3 text-[15px]">

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white text-blue-700 font-semibold shadow">
                        <i class="fas fa-chart-line"></i>
                        Dashboard
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-box"></i>
                        Data Barang
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-folder"></i>
                        Kategori
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-truck"></i>
                        Supplier
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-arrow-down"></i>
                        Barang Masuk
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-arrow-up"></i>
                        Barang Keluar
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-800 transition">
                        <i class="fas fa-file-alt"></i>
                        Laporan
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500 transition mt-8">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>

                </nav>

        </aside>

        <!-- Main -->
        <main class="flex-1">

                @include('components.navbar')

            <!-- Content -->
            <div class="p-8">

                <!-- Statistik -->
                <div class="grid md:grid-cols-4 gap-6 mb-8">

                    <div class="bg-white p-6 rounded-2xl shadow hover:-translate-y-1 transition">
                        <div class="flex justify-between items-center">
                            <p class="text-slate-500">Total Barang</p>
                            <i class="fas fa-box text-blue-500"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-blue-600 mt-3">1,250</h3>
                        <p class="text-green-500 text-sm mt-1">+12% bulan ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:-translate-y-1 transition">
                        <div class="flex justify-between items-center">
                            <p class="text-slate-500">Barang Masuk</p>
                            <i class="fas fa-arrow-down text-green-500"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-green-600 mt-3">45</h3>
                        <p class="text-green-500 text-sm mt-1">Hari ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:-translate-y-1 transition">
                        <div class="flex justify-between items-center">
                            <p class="text-slate-500">Barang Keluar</p>
                            <i class="fas fa-arrow-up text-red-500"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-red-600 mt-3">20</h3>
                        <p class="text-red-500 text-sm mt-1">Hari ini</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:-translate-y-1 transition">
                        <div class="flex justify-between items-center">
                            <p class="text-slate-500">Supplier</p>
                            <i class="fas fa-truck text-purple-500"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-purple-600 mt-3">18</h3>
                        <p class="text-slate-400 text-sm mt-1">Aktif</p>
                    </div>

                </div>

                <!-- Grafik -->
                <div class="bg-white p-6 rounded-2xl shadow mb-8">

                    <h3 class="font-bold text-xl mb-4">
                        <i class="fas fa-chart-area text-blue-600 mr-2"></i>
                        Pergerakan Stok
                    </h3>

                    <canvas id="stokChart" height="95"></canvas>

                </div>

                <!-- Table -->
                <div class="grid lg:grid-cols-3 gap-6 mb-8">

                    <!-- Transaksi -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">

                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-xl">
                                <i class="fas fa-table text-green-600 mr-2"></i>
                                Transaksi Terbaru
                            </h3>

                            <button class="text-sm text-blue-600 hover:underline">
                                Lihat Semua
                            </button>
                        </div>

                        <table class="w-full text-left">

                            <thead>
                                <tr class="border-b text-slate-500">
                                    <th class="py-3">Tanggal</th>
                                    <th>Barang</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr class="border-b hover:bg-slate-50">
                                    <td class="py-3">21 Apr</td>
                                    <td>Oli Mesin</td>
                                    <td>20</td>
                                    <td class="text-green-600 font-semibold">Masuk</td>
                                </tr>

                                <tr class="border-b hover:bg-slate-50">
                                    <td class="py-3">21 Apr</td>
                                    <td>Kampas Rem</td>
                                    <td>5</td>
                                    <td class="text-red-600 font-semibold">Keluar</td>
                                </tr>

                                <tr class="hover:bg-slate-50">
                                    <td class="py-3">20 Apr</td>
                                    <td>Aki Mobil</td>
                                    <td>8</td>
                                    <td class="text-green-600 font-semibold">Masuk</td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <!-- Alert -->
                    <div class="bg-white p-6 rounded-2xl shadow">

                        <h3 class="font-bold text-xl mb-4">
                            <i class="fas fa-triangle-exclamation text-red-500 mr-2"></i>
                            Stok Menipis
                        </h3>

                        <div class="space-y-3">

                            <div class="bg-red-50 text-red-600 p-3 rounded-xl">
                                Filter Udara - 2 pcs
                            </div>

                            <div class="bg-yellow-50 text-yellow-600 p-3 rounded-xl">
                                Busi - 4 pcs
                            </div>

                            <div class="bg-red-50 text-red-600 p-3 rounded-xl">
                                Lampu Depan - 1 pcs
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Quick Action -->
                <div class="bg-white p-6 rounded-2xl shadow mb-8">

                    <h3 class="font-bold text-xl mb-4">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                        Quick Action
                    </h3>

                    <div class="flex gap-4 flex-wrap">

                        <button class="bg-blue-600 text-white px-5 py-3 rounded-xl hover:bg-blue-700 transition">
                            <i class="fas fa-plus mr-2"></i> Barang
                        </button>

                        <button class="bg-purple-600 text-white px-5 py-3 rounded-xl hover:bg-green-700 transition">
                            <i class="fas fa-arrow-down mr-2"></i> Masuk
                        </button>

                        <button class="bg-red-600 text-white px-5 py-3 rounded-xl hover:bg-red-700 transition">
                            <i class="fas fa-arrow-up mr-2"></i> Keluar
                        </button>

                    </div>

                </div>

                <!-- Footer -->
                <div class="text-center text-sm text-slate-500 pb-6">
                    © 2026 GudangPro | Sistem Manajemen Stok Gudang
                </div>

            </div>

        </main>

    </div>

<script>
const ctx = document.getElementById('stokChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [
            {
                label: 'Masuk',
                data: [10,15,20,30,25,35,40],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.10)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            },
            {
                label: 'Keluar',
                data: [5,10,12,20,18,22,30],
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239,68,68,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            }
        ]
    },
    options: {
        responsive: true,

        animation: {
            duration: 2500
        },

        animations: {
            y: {
                from: 0
            }
        },

        plugins: {
            legend: {
                position: 'top'
            }
        },

        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>

</html>