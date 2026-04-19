<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StockGudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 font-sans">

<!-- NAVBAR -->
<nav class="bg-white/80 backdrop-blur shadow-md px-8 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">📦 StockGudang</h1>

    <div class="space-x-6 hidden md:flex font-medium">
        <a href="/" class="hover:text-blue-600 transition">Home</a>
        <a href="#fitur" class="hover:text-purple-600 transition">Fitur</a>
        <a href="/about" class="hover:text-pink-600 transition">Tentang Kami</a>
        <a href="/contact" class="hover:text-green-600 transition">Contact</a>
    </div>

    <div class="space-x-3">
        <a href="/login" class="border border-blue-500 text-blue-600 px-4 py-1 rounded hover:bg-blue-50 transition">Login</a>
    </div>
</nav>

<!-- HERO -->
<section class="container mx-auto px-8 py-16 grid md:grid-cols-2 items-center gap-10">

    <div>
        <h2 class="text-4xl md:text-5xl font-extrabold mb-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-500 bg-clip-text text-transparent">
            Kelola Stok Gudang Lebih Mudah & Cepat
        </h2>

        <p class="text-gray-600 mb-6 text-lg">
            Pantau barang masuk & keluar secara real-time dengan sistem digital modern
        </p>

        <!-- BUTTON -->
        <div class="flex gap-4 flex-wrap">
            <a href="#fitur" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg shadow-lg hover:scale-105 transition">
                🚀 Mulai Sekarang
            </a>

            <a href="/contact" class="border border-green-500 text-green-600 px-6 py-3 rounded-lg hover:bg-green-50 hover:scale-105 transition">
                📞 Hubungi Kami
            </a>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="bg-gradient-to-r from-blue-300 via-purple-300 to-pink-300 p-2 rounded-xl shadow-xl">
            <img src="{{ asset('images/gudang.png') }}" 
                 class="w-full max-w-md rounded-lg shadow-lg hover:scale-105 transition duration-500">
        </div>
    </div>

</section>

<!-- FITUR -->
<section id="fitur" class="container mx-auto px-8 py-12">
    <h3 class="text-3xl font-bold text-center mb-10 text-gray-800">✨ Fitur Unggulan</h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        <div class="h-36 bg-white rounded-xl shadow-md flex flex-col items-center justify-center p-4 hover:shadow-xl hover:-translate-y-2 transition">
            <span class="font-semibold text-blue-600 mb-2">📊 Monitoring Real-Time</span>
            <p class="text-sm text-gray-500 text-center">Pantau stok barang secara instan</p>
        </div>

        <div class="h-36 bg-white rounded-xl shadow-md flex flex-col items-center justify-center p-4 hover:shadow-xl hover:-translate-y-2 transition">
            <span class="font-semibold text-purple-600 mb-2">🔔 Notifikasi Otomatis</span>
            <p class="text-sm text-gray-500 text-center">Alert stok menipis / habis</p>
        </div>

        <div class="h-36 bg-white rounded-xl shadow-md flex flex-col items-center justify-center p-4 hover:shadow-xl hover:-translate-y-2 transition">
            <span class="font-semibold text-pink-600 mb-2">📈 Laporan Analitik</span>
            <p class="text-sm text-gray-500 text-center">Grafik & laporan detail</p>
        </div>

        <div class="h-36 bg-white rounded-xl shadow-md flex flex-col items-center justify-center p-4 hover:shadow-xl hover:-translate-y-2 transition">
            <span class="font-semibold text-green-600 mb-2">👥 Multi-User</span>
            <p class="text-sm text-gray-500 text-center">Akses banyak pengguna</p>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-8 py-10 mt-16">
    <div class="grid md:grid-cols-3 gap-6 text-sm">

        <div>
            <h4 class="font-bold mb-2 text-blue-400">StockGudang</h4>
            <p>Platform manajemen stok modern</p>
        </div>

        <div>
            <h4 class="font-bold mb-2 text-purple-400">Support</h4>
            <p>info@stockgudang.com</p>
            <p>0821-1392-5219</p>
        </div>

        <div>
            <h4 class="font-bold mb-2 text-pink-400">Kontak</h4>
            <p>Batam, Indonesia</p>
            <a href="/contact" class="text-green-400 hover:underline"> Contact Kami </a>
        </div>

    </div>

    <div class="text-center mt-6 text-gray-400">
        © 2024 StockGudang. All rights reserved
    </div>
</footer>

</body>
</html>