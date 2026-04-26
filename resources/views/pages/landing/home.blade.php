<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GudangPro | Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-gray-800">
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-8 h-20 flex justify-between items-center">

            <!-- LOGO -->
            <a href="/" class="flex items-center">

                <img src="{{ asset('images/LogoGudangPro.png') }}" alt="GudangPro Logo"
                    class="h-14 w-auto object-contain brightness-75 contrast-125">

            </a>

            <!-- MENU -->
            <div class="hidden md:flex items-center space-x-8 font-medium text-gray-700 ml-auto mr-10">
                <a href="/home" class="text-blue-700 font-semibold border-b-2 border-blue-700 pb-1">Beranda</a>
                <a href="/about" class="hover:text-blue-700 transition">Tentang Kami</a>
                <a href="/contact" class="hover:text-blue-700 transition">Kontak</a>
            </div>

            <!-- LOGIN -->
            <a href="/login" class="bg-blue-700 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-800 transition">
                Masuk
            </a>

        </div>
    </nav>

    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-100 via-slate-50 to-blue-50">
        <div class="container mx-auto px-8 py-20 grid md:grid-cols-2 gap-10 items-center min-h-[88vh]">

            <!-- LEFT -->
            <div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mt-5 mb-6 text-slate-900">
                    Kelola Stok Gudang Lebih Mudah & Cepat
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    Pantau barang masuk, barang keluar, stok spare part,
                    supplier, dan laporan gudang secara real-time dengan sistem modern.
                </p>

                <div class="flex gap-4 flex-wrap">

                    <a href="/login"
                        class="bg-blue-700 text-white px-7 py-3 rounded-xl shadow-lg hover:bg-blue-800 transition">
                        🚀 Mulai Sekarang
                    </a>

                    <a href="/contact"
                        class="border border-slate-300 text-slate-700 px-7 py-3 rounded-xl hover:bg-white transition">
                        📞 Hubungi Kami
                    </a>

                </div>

                <!-- STAT -->
                <div class="grid grid-cols-3 gap-4 mt-10">

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700">5000+</h3>
                        <p class="text-sm text-gray-500">Spare Part</p>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700">120+</h3>
                        <p class="text-sm text-gray-500">Supplier</p>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
                        <h3 class="text-2xl font-bold text-blue-700">99%</h3>
                        <p class="text-sm text-gray-500">Akurasi</p>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative flex justify-center items-center">

                <!-- soft background glow -->
                <div class="absolute w-[520px] h-[520px] bg-slate-200 rounded-full blur-3xl opacity-60"></div>

                <!-- image -->
                <img src="{{ asset('images/gudang.png') }}" alt="Gudang Dashboard" class="relative z-10 w-full max-w-3xl object-contain
                    brightness-105 contrast-95 saturate-90 opacity-95
                    mix-blend-multiply
                    transition duration-500">

            </div>

    </section>

    <!-- KEUNGGULAN -->
    <section class="bg-gradient-to-b from-white to-slate-50 py-24">

        <div class="container mx-auto px-8">

            <!-- TITLE -->
            <div class="text-center mb-16">

                <span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-sm font-semibold shadow-sm">
                    Platform Stok Gudang Terpercaya </span>

                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mt-6">
                    Keunggulan Sistem GudangPro
                </h2>

                <!-- garis bawah -->
                <div class="w-28 h-1 bg-blue-700 mx-auto rounded-full mt-5 mb-6"></div>

                <p class="text-gray-500 max-w-3xl mx-auto text-lg leading-relaxed">
                    Dirancang untuk membantu pengelolaan stok spare part kendaraan
                    menjadi lebih cepat, akurat, efisien, dan modern.
                </p>

            </div>

            <!-- CARD -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-7">

                <!-- CARD 1 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-blue-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-700
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Monitoring Stok
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Pantau barang masuk, keluar, dan jumlah stok secara real-time.
                    </p>

                </div>

                <!-- CARD 2 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-amber-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-amber-100 text-amber-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-bell"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Alert Otomatis
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Sistem memberi notifikasi saat stok spare part hampir habis.
                    </p>

                </div>

                <!-- CARD 3 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Laporan Lengkap
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Data penjualan, stok, supplier, dan transaksi tersusun otomatis.
                    </p>

                </div>

                <!-- CARD 4 -->
                <div class="h-full bg-white rounded-2xl p-7 shadow-sm border border-gray-100
                        hover:-translate-y-2 hover:shadow-2xl hover:border-purple-200
                        transition duration-300">

                    <div class="w-14 h-14 rounded-xl bg-purple-100 text-purple-600
                            flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        Multi User
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Bisa digunakan Admin Gudang dan Manajer bersamaan.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 mt-16">

        <div class="container mx-auto px-8 py-12">

            <!-- TOP -->
            <div class="grid md:grid-cols-4 gap-10 pb-10 border-b border-gray-200">

                <!-- BRAND -->
                <div>
                    <h3 class="text-3xl font-bold text-blue-700 mb-5">
                        GudangPro
                    </h3>

                    <ul class="space-y-3 text-gray-600 text-sm">
                        <li><a href="#" class="hover:text-blue-600 transition">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                        <li><a href="/about" class="hover:text-blue-600 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Panduan Sistem</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <!-- ADMIN -->

                <div>
                    <h4 class="text-2xl font-semibold text-gray-800 mb-5">
                        Tentang Sistem
                    </h4>

                    <ul class="space-y-3 text-gray-600 text-sm">
                        <li>Manajemen Stok Gudang</li>
                        <li>Spare Part Kendaraan</li>
                        <li>Monitoring Real-Time</li>
                        <li>Laporan Otomatis</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-2xl font-semibold text-gray-800 mb-5">
                        Keunggulan
                    </h4>

                    <ul class="space-y-3 text-gray-600 text-sm">
                        <li>Mudah Digunakan</li>
                        <li>Akses Multi User</li>
                        <li>Data Lebih Akurat</li>
                        <li>Efisien & Cepat</li>
                    </ul>
                </div>

                <!-- CUSTOMER CARE -->
                <div>
                    <h4 class="text-2xl font-semibold text-gray-800 mb-5">
                        Customer Care
                    </h4>

                    <div class="space-y-4 text-sm text-gray-600">

                        <p><i class="fa-brands fa-whatsapp text-green-500 mr-2"></i>0821-1392-5219</p>
                        <p><i class="fa-solid fa-envelope text-red-500 mr-2"></i>info@gudangpro.com</p>

                        <a href="/contact"
                            class="block text-center bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
                            Hubungi Kami
                        </a>

                    </div>

                </div>

            </div>

            <!-- BOTTOM -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-6">

                <!-- LANGUAGE SWITCHER -->
                <div class="relative inline-block">

                    <!-- BUTTON -->
                    <button onclick="toggleLangMenu()"
                        class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition">

                        <div class="w-10 h-7 rounded overflow-hidden border border-gray-300">
                            <div class="h-1/2 bg-red-600"></div>
                            <div class="h-1/2 bg-white"></div>
                        </div>

                        <span id="currentLangText" class="text-lg font-medium text-gray-800">
                            Indonesia
                        </span>

                        <span class="text-gray-400 text-sm">▼</span>

                    </button>

                    <!-- MENU -->
                    <div id="langMenu"
                        class="hidden absolute left-0 bottom-full mb-3 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">

                        <!-- ENGLISH -->
                        <button onclick="setLanguage('en')"
                            class="w-full flex items-center gap-4 px-5 py-4 hover:bg-blue-50 transition text-left">

                            <img src="https://flagcdn.com/w40/gb.png"
                                class="w-12 h-8 rounded border border-gray-300 object-cover">

                            <div>
                                <p class="text-gray-800 font-medium">English</p>
                                <p class="text-xs text-gray-400">United Kingdom</p>
                            </div>

                        </button>

                        <!-- INDONESIA -->
                        <button onclick="setLanguage('id')"
                            class="w-full flex items-center gap-4 px-5 py-4 hover:bg-red-50 transition border-t text-left">

                            <img src="https://flagcdn.com/w40/id.png"
                                class="w-12 h-8 rounded border border-gray-300 object-cover">

                            <div>
                                <p class="text-red-500 font-medium">Indonesia</p>
                                <p class="text-xs text-gray-400">Bahasa Default</p>
                            </div>

                        </button>

                    </div>

                </div>

                <!-- SOCIAL MEDIA -->
                <div class="flex gap-4">

                    <!-- Instagram -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-gradient-to-br from-pink-400 via-purple-500 to-yellow-400 shadow flex items-center justify-center hover:scale-110 transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7Zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10Zm-5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 2.2a2.8 2.8 0 1 1 0 5.6 2.8 2.8 0 0 1 0-5.6Zm4.3-.9a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z" />
                        </svg>
                    </a>

                    <!-- Twitter -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-sky-500 shadow flex items-center justify-center hover:scale-110 transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 5.8c-.7.3-1.5.5-2.3.6.8-.5 1.4-1.2 1.7-2.1-.8.5-1.7.8-2.6 1-1.5-1.6-4.2-1.7-5.8-.2-1 1-1.4 2.4-1.1 3.7-3.2-.2-6.1-1.7-8-4.1-1 1.8-.5 4 1.1 5.2-.6 0-1.2-.2-1.7-.5 0 2 1.4 3.8 3.4 4.2-.6.2-1.2.2-1.8.1.5 1.7 2.1 2.9 3.9 2.9A7.8 7.8 0 0 1 2 19.5 11 11 0 0 0 8 21c7.2 0 11.2-6 11.2-11.2v-.5c.8-.5 1.5-1.1 2-1.8Z" />
                        </svg>
                    </a>

                    <!-- YouTube -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-white border border-gray-200 shadow flex items-center justify-center hover:scale-110 transition">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.4 3.5 12 3.5 12 3.5s-7.4 0-9.4.6A3 3 0 0 0 .5 6.2 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c2 .6 9.4.6 9.4.6s7.4 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.8ZM10 15.5v-7l6 3.5-6 3.5Z" />
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-gradient-to-br from-slate-500 to-blue-900 shadow flex items-center justify-center hover:scale-110 transition">
                        <span class="text-white text-xl font-bold">f</span>
                    </a>

                </div>

                <!-- COPYRIGHT -->
                <div class="text-sm text-gray-500 text-center">
                    © 2026 GudangPro Copyright
                </div>

            </div>

        </div>

    </footer>

<script>
function toggleLangMenu() {
    document.getElementById("langMenu").classList.toggle("hidden");
}

function setLanguage(lang){

    localStorage.setItem("lang", lang);

    /* NAVBAR */
    const navLinks = document.querySelectorAll("nav .md\\:flex a");
    const loginBtn = document.querySelector("nav > div > a:last-child");

    navLinks[0].textContent = lang === "en" ? "Home" : "Beranda";
    navLinks[1].textContent = lang === "en" ? "About Us" : "Tentang Kami";
    navLinks[2].textContent = lang === "en" ? "Contact" : "Kontak";
    loginBtn.textContent   = lang === "en" ? "Login" : "Masuk";

    /* HERO */
    document.querySelector("section h1").textContent =
        lang === "en"
        ? "Manage Warehouse Stock Faster & Easier"
        : "Kelola Stok Gudang Lebih Mudah & Cepat";

    document.querySelector("section p").textContent =
        lang === "en"
        ? "Monitor incoming goods, outgoing goods, spare part stock, suppliers, and warehouse reports in real-time with a modern system."
        : "Pantau barang masuk, barang keluar, stok spare part, supplier, dan laporan gudang secara real-time dengan sistem modern.";

    const heroBtn = document.querySelectorAll("section .flex a");
    heroBtn[0].textContent = lang === "en" ? "🚀 Get Started" : "🚀 Mulai Sekarang";
    heroBtn[1].textContent = lang === "en" ? "📞 Contact Us" : "📞 Hubungi Kami";

    /* STAT */
    const stat = document.querySelectorAll(".grid.grid-cols-3 p");
    stat[0].textContent = lang === "en" ? "Spare Parts" : "Spare Part";
    stat[1].textContent = lang === "en" ? "Suppliers" : "Supplier";
    stat[2].textContent = lang === "en" ? "Accuracy" : "Akurasi";

    /* FEATURE */
    const second = document.querySelectorAll("section")[1];

    second.querySelector("span").textContent =
        lang === "en"
        ? "Trusted Warehouse Stock Platform"
        : "Platform Stok Gudang Terpercaya";

    second.querySelector("h2").textContent =
        lang === "en"
        ? "GudangPro System Advantages"
        : "Keunggulan Sistem GudangPro";

    second.querySelector(".text-center p").textContent =
        lang === "en"
        ? "Designed to help manage vehicle spare part stock faster, more accurately, efficiently and modernly."
        : "Dirancang untuk membantu pengelolaan stok spare part kendaraan menjadi lebih cepat, akurat, efisien, dan modern.";

    /* CARD */
    const cards = second.querySelectorAll(".grid.sm\\:grid-cols-2 > div");

    const titleEn = ["Stock Monitoring","Automatic Alerts","Complete Reports","Multi User"];
    const descEn = [
        "Monitor incoming goods, outgoing goods and stock quantities in real-time.",
        "System sends notifications when spare part stock is running low.",
        "Sales, stock, supplier and transaction data are automatically organized.",
        "Can be used simultaneously by Warehouse Admin and Manager."
    ];

    const titleId = ["Monitoring Stok","Alert Otomatis","Laporan Lengkap","Multi User"];
    const descId = [
        "Pantau barang masuk, keluar, dan jumlah stok secara real-time.",
        "Sistem memberi notifikasi saat stok spare part hampir habis.",
        "Data penjualan, stok, supplier, dan transaksi tersusun otomatis.",
        "Bisa digunakan Admin Gudang dan Manajer bersamaan."
    ];

    cards.forEach((card,i)=>{
        card.querySelector("h3").textContent = lang === "en" ? titleEn[i] : titleId[i];
        card.querySelector("p").textContent  = lang === "en" ? descEn[i] : descId[i];
    });

    /* FOOTER */
    const footer = document.querySelector("footer");
    const h4 = footer.querySelectorAll("h4");
    const li = footer.querySelectorAll("li");
    const footerBtn = footer.querySelector(".bg-blue-700");

    if(lang === "en"){
        h4[0].textContent = "About System";
        h4[1].textContent = "Advantages";
        h4[2].textContent = "Customer Care";

        const txt = [
            "Help Center","FAQ","About Us","System Guide","Terms & Conditions",
            "Warehouse Stock Management","Vehicle Spare Parts","Real-Time Monitoring","Automatic Reports",
            "Easy to Use","Multi User Access","More Accurate Data","Efficient & Fast"
        ];

        li.forEach((item,i)=> item.textContent = txt[i]);
        footerBtn.textContent = "Contact Us";

    }else{
        h4[0].textContent = "Tentang Sistem";
        h4[1].textContent = "Keunggulan";
        h4[2].textContent = "Customer Care";

        const txt = [
            "Pusat Bantuan","FAQ","Tentang Kami","Panduan Sistem","Syarat & Ketentuan",
            "Manajemen Stok Gudang","Spare Part Kendaraan","Monitoring Real-Time","Laporan Otomatis",
            "Mudah Digunakan","Akses Multi User","Data Lebih Akurat","Efisien & Cepat"
        ];

        li.forEach((item,i)=> item.textContent = txt[i]);
        footerBtn.textContent = "Hubungi Kami";
    }

    /* BAHASA TEXT */
    document.getElementById("currentLangText").textContent =
        lang === "en" ? "English" : "Indonesia";

    /* BENDERA */
    const flag = document.querySelector(".relative.inline-block .w-10");

    if(lang === "en"){
        flag.innerHTML = `
            <img src="https://flagcdn.com/w40/gb.png"
            class="w-full h-full object-cover">
        `;
    }else{
        flag.innerHTML = `
            <div class="h-1/2 bg-red-600"></div>
            <div class="h-1/2 bg-white"></div>
        `;
    }

    document.getElementById("langMenu").classList.add("hidden");
}

window.onload = function(){
    setLanguage(localStorage.getItem("lang") || "id");
}
</script>

</body>

</html>