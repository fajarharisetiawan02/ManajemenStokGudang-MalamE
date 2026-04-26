function toggleLangMenu() {
    document.getElementById("langMenu")?.classList.toggle("hidden");
}

function setLanguage(lang) {
    localStorage.setItem("lang", lang);

    // ======================
    // NAVBAR (HOME) - FIX
    // ======================
    const navLinks = document.querySelectorAll("nav .md\\:flex a");

    if (navLinks.length >= 3) {
        navLinks[0].textContent = lang === "en" ? "Home" : "Beranda";
        navLinks[1].textContent = lang === "en" ? "About Us" : "Tentang Kami";
        navLinks[2].textContent = lang === "en" ? "Contact" : "Kontak";
    }

    const loginBtn = document.querySelector("a[href='/login']");
    if (loginBtn) {
    loginBtn.textContent = lang === "en" ? "Login" : "Masuk";
    }

    // ======================
    // HERO
    // ======================
    const h1 = document.querySelector("section h1");
    if (h1) {
        h1.textContent = lang === "en"
            ? "Manage Warehouse Stock Faster & Easier"
            : "Kelola Stok Gudang Lebih Mudah & Cepat";
    }

    const heroDesc = document.querySelector("section p");
    if (heroDesc) {
        heroDesc.textContent = lang === "en"
            ? "Monitor incoming goods, outgoing goods, spare part stock, suppliers, and warehouse reports in real-time with a modern system."
            : "Pantau barang masuk, barang keluar, stok spare part, supplier, dan laporan gudang secara real-time dengan sistem modern.";
    }

    const heroBtn = document.querySelectorAll("section .flex a");
    if (heroBtn.length >= 2) {
        heroBtn[0].textContent = lang === "en" ? "🚀 Get Started" : "🚀 Mulai Sekarang";
        heroBtn[1].textContent = lang === "en" ? "📞 Contact Us" : "📞 Hubungi Kami";
    }

    // ======================
    // STAT
    // ======================
    const stat = document.querySelectorAll(".grid.grid-cols-3 p");

    if (stat.length >= 3) {
        stat[0].textContent = lang === "en" ? "Spare Parts" : "Spare Part";
        stat[1].textContent = lang === "en" ? "Suppliers" : "Supplier";
        stat[2].textContent = lang === "en" ? "Accuracy" : "Akurasi";
    }

    // ======================
    // FEATURE SECTION
    // ======================
    const sections = document.querySelectorAll("section");
    if (sections.length > 1) {

        const second = sections[1];

        const span = second.querySelector("span");
        if (span) {
            span.textContent = lang === "en"
                ? "Trusted Warehouse Stock Platform"
                : "Platform Stok Gudang Terpercaya";
        }

        const h2 = second.querySelector("h2");
        if (h2) {
            h2.textContent = lang === "en"
                ? "GudangPro System Advantages"
                : "Keunggulan Sistem GudangPro";
        }

        const desc = second.querySelector(".text-center p");
        if (desc) {
            desc.textContent = lang === "en"
                ? "Designed to help manage vehicle spare part stock faster, more accurately, efficiently and modernly."
                : "Dirancang untuk membantu pengelolaan stok spare part kendaraan menjadi lebih cepat, akurat, efisien, dan modern.";
        }

        // CARD
        const cards = second.querySelectorAll(".grid.sm\\:grid-cols-2 > div");

        const titleEn = ["Stock Monitoring", "Automatic Alerts", "Complete Reports", "Multi User"];
        const descEn = [
            "Monitor incoming goods, outgoing goods and stock quantities in real-time.",
            "System sends notifications when spare part stock is running low.",
            "Sales, stock, supplier and transaction data are automatically organized.",
            "Can be used simultaneously by Warehouse Admin and Manager."
        ];

        const titleId = ["Monitoring Stok", "Alert Otomatis", "Laporan Lengkap", "Multi User"];
        const descId = [
            "Pantau barang masuk, keluar, dan jumlah stok secara real-time.",
            "Sistem memberi notifikasi saat stok spare part hampir habis.",
            "Data penjualan, stok, supplier, dan transaksi tersusun otomatis.",
            "Bisa digunakan Admin Gudang dan Manajer bersamaan."
        ];

        cards.forEach((card, i) => {
            const h3 = card.querySelector("h3");
            const p = card.querySelector("p");

            if (h3) h3.textContent = lang === "en" ? titleEn[i] : titleId[i];
            if (p) p.textContent = lang === "en" ? descEn[i] : descId[i];
        });
    }

    // ======================
    // FOOTER
    // ======================
    const footer = document.querySelector("footer");

    if (footer) {
        const h4 = footer.querySelectorAll("h4");
        const li = footer.querySelectorAll("li");
        const footerBtn = footer.querySelector(".bg-blue-700");

        if (h4.length >= 3) {
            if (lang === "en") {
                h4[0].textContent = "About System";
                h4[1].textContent = "Advantages";
                h4[2].textContent = "Customer Care";
            } else {
                h4[0].textContent = "Tentang Sistem";
                h4[1].textContent = "Keunggulan";
                h4[2].textContent = "Customer Care";
            }
        }

        if (li.length > 0) {
            const txtEn = [
                "Help Center", "FAQ", "About Us", "System Guide", "Terms & Conditions",
                "Warehouse Stock Management", "Vehicle Spare Parts", "Real-Time Monitoring",
                "Automatic Reports",
                "Easy to Use", "Multi User Access", "More Accurate Data", "Efficient & Fast"
            ];

            const txtId = [
                "Pusat Bantuan", "FAQ", "Tentang Kami", "Panduan Sistem", "Syarat & Ketentuan",
                "Manajemen Stok Gudang", "Spare Part Kendaraan", "Monitoring Real-Time", "Laporan Otomatis",
                "Mudah Digunakan", "Akses Multi User", "Data Lebih Akurat", "Efisien & Cepat"
            ];

            li.forEach((item, i) => {
                item.textContent = lang === "en" ? txtEn[i] : txtId[i];
            });
        }

        if (footerBtn) {
            footerBtn.textContent = lang === "en" ? "Contact Us" : "Hubungi Kami";
        }
    }

    // ======================
    // LANGUAGE DISPLAY
    // ======================
    const langText = document.getElementById("currentLangText");
    if (langText) {
        langText.textContent = lang === "en" ? "English" : "Indonesia";
    }

    const flag = document.getElementById("langFlag");
    if (flag) {
        flag.innerHTML = lang === "en"
            ? `<img src="https://flagcdn.com/w40/gb.png" class="w-full h-full object-cover">`
            : `<div class="h-1/2 bg-red-600"></div><div class="h-1/2 bg-white"></div>`;
    }

    document.getElementById("langMenu")?.classList.add("hidden");
}

// GLOBAL
window.toggleLangMenu = toggleLangMenu;
window.setLanguage = setLanguage;

// AUTO LOAD
window.addEventListener("DOMContentLoaded", () => {
    setLanguage(localStorage.getItem("lang") || "id");
});