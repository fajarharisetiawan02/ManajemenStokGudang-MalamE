<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact - StockGudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 font-sans">

<!-- NAVBAR -->
<nav class="bg-white/80 backdrop-blur shadow-md px-8 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">📦 StockGudang</h1>

    <div class="space-x-6 font-medium">
        <a href="/" class="hover:text-blue-600 transition">Home</a>
        <a href="/about" class="hover:text-purple-600 transition">Tentang Kami</a>
        <a href="/contact" class="text-pink-600 font-bold border-b-2 border-pink-600 pb-1">
            Contact
        </a>
    </div>
</nav>

<!-- CONTACT SECTION -->
<section class="bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#0f172a] py-20 text-white">

    <div class="max-w-6xl mx-auto px-6">

        <!-- TOP -->
        <div class="grid md:grid-cols-2 gap-10 items-center mb-16">

            <!-- TEXT -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    📞 Get in Touch
                </h1>

                <p class="text-gray-300 text-lg mb-6">
                    Kami siap membantu Anda dalam pengelolaan sistem stok gudang.
                    Hubungi kami melalui WhatsApp untuk respon cepat dan solusi terbaik.
                </p>

                <a href="https://wa.me/628213925219"
                   class="inline-block bg-green-500 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-green-600 hover:scale-105 transition">
                   💬 Chat Sekarang
                </a>
            </div>

            <!-- IMAGE -->
            <div>
                <img src="{{ asset('images/Stock gudang.webp') }}"
                     class="rounded-2xl shadow-2xl w-full h-[300px] object-cover">
            </div>

        </div>

        <!-- CONTACT CARDS -->
        <div class="grid md:grid-cols-3 gap-8">

            <!-- ADMIN 1 -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-6 rounded-2xl shadow-xl hover:scale-105 transition">
                <div class="text-5xl mb-3">🟢</div>
                <h3 class="text-xl font-bold">Admin 1</h3>
                <p class="text-gray-300 mb-4">Fast Response</p>

                <a href="https://wa.me/628213925219?text=Halo Admin 1"
                   class="block bg-green-500 py-2 rounded-lg text-center font-semibold hover:bg-green-600 transition">
                   Chat WhatsApp
                </a>
            </div>

            <!-- ADMIN 2 -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-6 rounded-2xl shadow-xl hover:scale-105 transition">
                <div class="text-5xl mb-3">👨‍💻</div>
                <h3 class="text-xl font-bold">Admin 2</h3>
                <p class="text-gray-300 mb-4">Customer Support</p>

                <a href="https://wa.me/6281273873829?text=Halo Admin 2"
                   class="block bg-green-500 py-2 rounded-lg text-center font-semibold hover:bg-green-600 transition">
                   Chat WhatsApp
                </a>
            </div>

            <!-- ADMIN 3 -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-6 rounded-2xl shadow-xl hover:scale-105 transition">
                <div class="text-5xl mb-3">🛠️</div>
                <h3 class="text-xl font-bold">Admin 3</h3>
                <p class="text-gray-300 mb-4">Technical Support</p>

                <a href="https://wa.me/6289669022882?text=Halo Admin 3"
                   class="block bg-green-500 py-2 rounded-lg text-center font-semibold hover:bg-green-600 transition">
                   Chat WhatsApp
                </a>
            </div>

        </div>

    </div>
</section>

<!-- FLOATING WHATSAPP -->
<a href="https://wa.me/628213925219"
   class="fixed bottom-6 right-6 bg-green-500 p-4 rounded-full shadow-2xl hover:bg-green-600 transition text-white text-xl">
   💬
</a>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white text-center py-6">
    <p class="text-gray-400">© 2024 StockGudang. All rights reserved</p>
</footer>

</body>
</html>