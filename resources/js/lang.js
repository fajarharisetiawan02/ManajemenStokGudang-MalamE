function toggleLangMenu() {
    document.getElementById("langMenu")?.classList.toggle("hidden");
}

function setLanguage(lang) {
    localStorage.setItem("lang", lang);

// ======================
// LOGIN PAGE (FIX)
// ======================
const loginPage = document.getElementById("loginPage");

if (loginPage) {
    const title = loginPage.querySelector("h2");
    const desc = loginPage.querySelector("h2 + p");
    const backBtn = loginPage.querySelector("header a");
    const loginBtn = loginPage.querySelector("button[type='submit']");
    const label = loginPage.querySelectorAll("label");
    const forgot = document.getElementById("forgotPassword");

    if (lang === "en") {
        if (title) title.textContent = "Welcome 👋";
        if (desc) desc.textContent = "Login to manage your warehouse stock.";
        if (backBtn) backBtn.textContent = "Back to Home";
        if (loginBtn) loginBtn.textContent = "Login";

        if (label[0]) label[0].textContent = "Email / Username";
        if (label[1]) label[1].textContent = "Password";

        if (forgot) forgot.textContent = "Forgot your Password?";
    } else {
        if (title) title.textContent = "Selamat Datang 👋";
        if (desc) desc.textContent = "Masuk untuk mengelola stok gudang Anda.";
        if (backBtn) backBtn.textContent = "Kembali ke Beranda";
        if (loginBtn) loginBtn.textContent = "Masuk";

        if (label[0]) label[0].textContent = "Email / Username";
        if (label[1]) label[1].textContent = "Kata Sandi";

        if (forgot) forgot.textContent = "Lupa Kata Sandi?";
    }
}

    // ======================
    // FOOTER
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

    // ======================
    // SIDEBAR
    // ======================
    const menuTexts = document.querySelectorAll("nav p");
    const links = document.querySelectorAll("nav a span");

    if (menuTexts.length >= 4) {
        if (lang === "en") {
            menuTexts[0].textContent = "Main";
            menuTexts[1].textContent = "Master";
            menuTexts[2].textContent = "Transaction";
            menuTexts[3].textContent = "Report";
        } else {
            menuTexts[0].textContent = "Main";
            menuTexts[1].textContent = "Master";
            menuTexts[2].textContent = "Transaksi";
            menuTexts[3].textContent = "Laporan";
        }
    }

    if (links.length >= 7) {
        if (lang === "en") {
            links[0].textContent = "Dashboard";
            links[1].textContent = "Items";
            links[2].textContent = "Category";
            links[3].textContent = "Supplier";
            links[4].textContent = "Stock In";
            links[5].textContent = "Stock Out";
            links[6].textContent = "Report";
        } else {
            links[0].textContent = "Dashboard";
            links[1].textContent = "Data Barang";
            links[2].textContent = "Kategori";
            links[3].textContent = "Supplier";
            links[4].textContent = "Barang Masuk";
            links[5].textContent = "Barang Keluar";
            links[6].textContent = "Laporan";
        }
    }

    const logout = document.getElementById("menuLogout");
    if (logout) {
        logout.textContent = lang === "en" ? "Logout" : "Keluar";
    }

    document.getElementById("langMenu")?.classList.add("hidden");
}

// GLOBAL
window.toggleLangMenu = toggleLangMenu;
window.setLanguage = setLanguage;

// AUTO LOAD
window.addEventListener("load", () => {
    setLanguage(localStorage.getItem("lang") || "id");
});