<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 font-sans">

<!-- NAVBAR -->
<nav class="bg-white/80 backdrop-blur shadow-md px-8 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">📦 StockGudang</h1>

    <div class="space-x-6 font-medium">
        <a href="/" class="hover:text-blue-600">Home</a>
        <a href="/about" class="text-purple-600 font-bold border-b-2 border-purple-600 pb-1">
            Tentang Kami
        </a>
    </div>
</nav>

<!-- HERO -->
<section class="text-center py-16 px-6">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-500 bg-clip-text text-transparent">
        Tentang StockGudang
    </h2>

    <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Solusi modern untuk manajemen stok gudang yang lebih cepat, efisien, dan terintegrasi.
    </p>
</section>

<!-- ABOUT CONTENT -->
<section class="container mx-auto px-8 py-10 grid md:grid-cols-2 gap-10 items-center">

    <!-- IMAGE -->
    <div>
        <img src="{{ asset('images/about.png') }}" 
             class="rounded-2xl shadow-xl hover:scale-105 transition duration-500">
    </div>

    <!-- TEXT -->
    <div>
        <h3 class="text-2xl font-bold mb-4 text-gray-800">Siapa Kami?</h3>

        <p class="text-gray-600 mb-4">
            <strong>StockGudang</strong> adalah platform digital yang dirancang untuk membantu bisnis 
            dalam mengelola stok barang dengan lebih efisien dan akurat.
        </p>

        <p class="text-gray-600 mb-6">
            Kami menghadirkan solusi yang mempermudah pencatatan barang masuk & keluar, 
            monitoring stok secara real-time, serta analisis data untuk pengambilan keputusan yang lebih baik.
        </p>

        <div class="flex gap-4 flex-wrap">
            <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold">✔ Mudah Digunakan</span>
            <span class="bg-purple-100 text-purple-600 px-4 py-2 rounded-lg font-semibold">✔ Cepat & Akurat</span>
            <span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-lg font-semibold">✔ Real-Time</span>
        </div>
    </div>

</section>

<!-- VISI MISI -->
<section class="container mx-auto px-8 py-16 grid md:grid-cols-2 gap-8">

    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
        <h4 class="text-xl font-bold text-blue-600 mb-3">🎯 Visi</h4>
        <p class="text-gray-600">
            Menjadi platform manajemen gudang terbaik yang membantu bisnis berkembang melalui teknologi digital.
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
        <h4 class="text-xl font-bold text-purple-600 mb-3">🚀 Misi</h4>
        <ul class="text-gray-600 space-y-2">
            <li>• Menyediakan sistem yang mudah digunakan</li>
            <li>• Meningkatkan efisiensi operasional</li>
            <li>• Memberikan data akurat & real-time</li>
        </ul>
    </div>

</section>

<!-- CTA -->
<section class="text-center py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <h3 class="text-3xl font-bold mb-4">Siap Mengelola Gudang Lebih Mudah?</h3>
    <p class="mb-6">Mulai sekarang dan rasakan kemudahan sistem kami</p>

    <a href="/register" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold shadow hover:scale-105 transition">
        🚀 Daftar Sekarang
    </a>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white px-8 py-8 text-center">
    <p class="text-gray-400">© 2024 StockGudang. All rights reserved</p>
</footer>

</body>
</html>