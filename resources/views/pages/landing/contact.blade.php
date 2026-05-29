<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GudangPro</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <x-landing-navbar />

    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 text-white py-24">

        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/20 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500/20 blur-3xl rounded-full"></div>

        <div class="relative max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <div>

                    <span class="px-4 py-2 bg-blue-500/20 border border-blue-400/30 rounded-full text-blue-300 text-sm">
                        🚀 GudangPro Support Center
                    </span>

                    <h1 class="text-5xl md:text-6xl font-black mt-8 leading-tight">
                        Hubungi Tim
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
                            GudangPro
                        </span>
                    </h1>

                    <p class="text-slate-300 text-xl mt-8 leading-relaxed">
                        Kami siap membantu pengelolaan inventaris, supplier,
                        barang masuk, barang keluar, dan laporan gudang Anda
                        dengan layanan profesional dan respons cepat.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">

                        <a href="https://wa.me/6282113925219"
                            class="bg-gradient-to-r from-blue-600 to-cyan-500 px-8 py-4 rounded-2xl font-bold shadow-2xl hover:scale-105 transition">
                            💬 Hubungi Sekarang
                        </a>

                        <a href="#team"
                            class="border border-white/20 px-8 py-4 rounded-2xl hover:bg-white/10 transition">
                            Tim Support
                        </a>

                    </div>

                </div>

                <div>
                    <img
                        src="{{ asset('images/Stock gudang.webp') }}"
                        alt="Gudang"
                        class="rounded-3xl shadow-[0_0_50px_rgba(59,130,246,0.3)] w-full h-[450px] object-cover">
                </div>

            </div>

        </div>

    </section>

    <!-- STATS -->
    <section class="bg-slate-950 py-16">

        <div class="max-w-6xl mx-auto px-6">

            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 text-center">
                    <h2 class="text-5xl font-black text-cyan-400">24/7</h2>
                    <p class="text-slate-400 mt-2">Support Online</p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 text-center">
                    <h2 class="text-5xl font-black text-blue-400">100+</h2>
                    <p class="text-slate-400 mt-2">Pengguna Aktif</p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 text-center">
                    <h2 class="text-5xl font-black text-green-400">99%</h2>
                    <p class="text-slate-400 mt-2">Response Rate</p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 text-center">
                    <h2 class="text-5xl font-black text-yellow-400">5★</h2>
                    <p class="text-slate-400 mt-2">Customer Rating</p>
                </div>

            </div>

        </div>

    </section>

    <!-- TEAM SUPPORT -->
    <section id="team" class="py-24 bg-slate-100">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">

                <h2 class="text-5xl font-black text-slate-900">
                    Tim Support Profesional
                </h2>

                <p class="text-slate-500 text-lg mt-4">
                    Siap membantu kebutuhan sistem gudang Anda
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8">

                <!-- ADMIN 1 -->
                <div class="bg-white rounded-[32px] p-8 shadow-xl hover:-translate-y-3 hover:shadow-2xl transition">

                    <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center text-5xl mb-6">
                        🟢
                    </div>

                    <h3 class="text-2xl font-bold">Admin 1</h3>

                    <p class="text-slate-500 mt-2">
                        Fast Response Specialist
                    </p>

                    <a href="https://wa.me/628213925219?text=Halo Admin 1"
                        class="block mt-8 bg-green-500 text-white text-center py-4 rounded-2xl font-bold hover:bg-green-600 transition">
                        Chat WhatsApp
                    </a>

                </div>

                <!-- ADMIN 2 -->
                <div class="bg-white rounded-[32px] p-8 shadow-xl hover:-translate-y-3 hover:shadow-2xl transition">

                    <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-5xl mb-6">
                        👨‍💻
                    </div>

                    <h3 class="text-2xl font-bold">Admin 2</h3>

                    <p class="text-slate-500 mt-2">
                        Customer Support Expert
                    </p>

                    <a href="https://wa.me/6281273873829?text=Halo Admin 2"
                        class="block mt-8 bg-blue-500 text-white text-center py-4 rounded-2xl font-bold hover:bg-blue-600 transition">
                        Chat WhatsApp
                    </a>

                </div>

                <!-- ADMIN 3 -->
                <div class="bg-white rounded-[32px] p-8 shadow-xl hover:-translate-y-3 hover:shadow-2xl transition">

                    <div class="w-24 h-24 rounded-full bg-yellow-100 flex items-center justify-center text-5xl mb-6">
                        🛠️
                    </div>

                    <h3 class="text-2xl font-bold">Admin 3</h3>

                    <p class="text-slate-500 mt-2">
                        Technical Support Engineer
                    </p>

                    <a href="https://wa.me/6289669022882?text=Halo Admin 3"
                        class="block mt-8 bg-yellow-500 text-white text-center py-4 rounded-2xl font-bold hover:bg-yellow-600 transition">
                        Chat WhatsApp
                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="bg-gradient-to-r from-blue-600 to-cyan-500 py-20">

        <div class="max-w-5xl mx-auto text-center px-6 text-white">

            <h2 class="text-4xl md:text-5xl font-black">
                Siap Mengelola Gudang Lebih Efisien?
            </h2>

            <p class="mt-6 text-xl opacity-90">
                Hubungi tim kami dan dapatkan solusi terbaik
                untuk manajemen inventaris perusahaan Anda.
            </p>

            <a href="https://wa.me/628213925219"
                class="inline-block mt-10 bg-white text-blue-600 px-10 py-4 rounded-2xl font-bold shadow-2xl hover:scale-105 transition">
                🚀 Mulai Sekarang
            </a>

        </div>

    </section>

    <!-- FLOATING WA -->
    <a href="https://wa.me/628213925219"
        class="fixed bottom-8 right-8 w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-3xl shadow-2xl hover:scale-110 transition z-50">
        💬
    </a>

    <!-- FOOTER -->
    <footer class="bg-slate-950 py-8 text-center">

        <h3 class="text-white font-bold text-xl mb-2">
            GudangPro
        </h3>

        <p class="text-slate-500">
            Inventory Management System
        </p>

        <p class="text-slate-600 mt-4">
            © 2026 GudangPro. All Rights Reserved.
        </p>

    </footer>

</body>
</html>