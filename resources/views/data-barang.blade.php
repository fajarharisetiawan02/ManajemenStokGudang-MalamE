<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GudangPro | Data Barang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 font-sans">

    <div class="flex h-screen">

        @include('components.sidebar')

        <!-- MAIN -->
        <main class="ml-72 flex flex-col flex-1">

            @include('components.navbar')

            <!-- CONTENT -->
            <div class="p-10 flex-1 overflow-y-auto">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">
                        <i class="fas fa-box text-blue-600 mr-2"></i>
                        Data Barang
                    </h1>


                </div>

                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">

                    <!-- LEFT: SEARCH + FILTER -->
                    <div class="flex flex-wrap items-center gap-3">

                        <!-- SEARCH -->
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" placeholder="Cari barang..."
                                class="pl-10 pr-4 py-2 border rounded-xl w-64 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <!-- FILTER KATEGORI -->
                        <select
                            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Semua Kategori</option>
                            <option>Oli</option>
                            <option>Rem</option>
                            <option>Kelistrikan</option>
                        </select>

                        <!-- FILTER SUPPLIER -->
                        <select
                            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Semua Supplier</option>
                            <option>PT Astra</option>
                            <option>PT Remindo</option>
                        </select>

                        <!-- FILTER STOK -->
                        <select
                            class="px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Semua Stok</option>
                            <option>Stok Aman</option>
                            <option>Stok Menipis</option>
                        </select>

                        <!-- RESET -->
                        <button class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                            Reset
                        </button>

                    </div>

                    <!-- RIGHT: BUTTON -->
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md hover:shadow-lg transition active:scale-95">
                        <i class="fas fa-plus mr-2"></i> Tambah Barang
                    </button>

                </div>

                <!-- TABLE -->
                <div class="bg-white rounded-2xl shadow overflow-hidden">

                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">No Part</th>
                                <th class="px-4 py-3 text-left">Nama Barang</th>
                                <th class="px-4 py-3 text-left">Kategori</th>
                                <th class="px-4 py-3 text-center">Stok</th>
                                <th class="px-4 py-3 text-left">Harga</th>
                                <th class="px-4 py-3 text-left">Supplier</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="border-t hover:bg-blue-50 even:bg-slate-50 transition">
                                <td class="px-4 py-3">1</td>
                                <td class="px-4 py-3 font-mono text-xs">04465-0D070</td>
                                <td class="px-4 py-3">Oli Mesin</td>
                                <td class="px-4 py-3">Oli</td>

                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-xs font-semibold">
                                        50
                                    </span>
                                </td>

                                <td class="px-4 py-3 font-semibold">Rp 150.000</td>
                                <td class="px-4 py-3">PT Astra</td>

                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-2">
                                        <button class="bg-yellow-400 text-white px-3 py-1 rounded-lg">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="bg-red-500 text-white px-3 py-1 rounded-lg">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>

            <!-- FOOTER -->
            <footer class="pb-4">
                <div class="w-full bg-white border-t border-gray-200 px-6 py-4 flex justify-between">
                    <div class="flex items-center gap-3 px-4 py-2 border bg-gray-50">
                        <div class="w-8 h-5 overflow-hidden border">
                            <div class="h-1/2 bg-red-600"></div>
                            <div class="h-1/2 bg-white"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Indonesia</span>
                    </div>

                    <div class="text-sm text-gray-500">
                        © 2026 <span class="font-semibold text-gray-700">GudangPro</span>
                    </div>
                </div>
            </footer>

        </main>

    </div>

</body>

</html>