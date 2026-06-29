<nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
    <div class="container mx-auto px-4 md:px-8 h-20 flex justify-between items-center">

        <!-- LOGO -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/LogoGudangPro.png') }}" alt="GudangPro Logo"
                class="h-14 w-auto object-contain brightness-75 contrast-125">
        </a>

        <!-- MENU DESKTOP -->
        <div class="hidden md:flex items-center space-x-8 font-medium text-gray-700 ml-auto mr-10">
            <a href="/home" class="hover:text-blue-700 transition
                {{ request()->is('/') || request()->is('home') ? 'text-blue-700 font-semibold border-b-2 border-blue-700 pb-1' : '' }}">
                {{ __('app.beranda') }}
            </a>
            <a href="/home#keunggulan" class="hover:text-blue-700 transition">
                Fitur
            </a>
        </div>

        <!-- HAMBURGER MOBILE -->
        <button id="mobileMenuBtn" onclick="toggleMobileMenu()"
            class="md:hidden text-gray-700 text-xl mr-3">
            <i id="menuIcon" class="fas fa-bars"></i>
        </button>

        <!-- LOGIN -->
        <a href="/login" class="bg-blue-700 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-800 transition">
            {{ __('app.masuk') }}
        </a>

    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 px-4 md:px-8 py-4 space-y-3">
        <a href="/home" class="block font-medium text-gray-700 hover:text-blue-700 transition
            {{ request()->is('/') || request()->is('home') ? 'text-blue-700 font-semibold' : '' }}">
            {{ __('app.beranda') }}
        </a>
        <a href="/home#keunggulan" class="block font-medium text-gray-700 hover:text-blue-700 transition">
            Fitur
        </a>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('menuIcon');
    menu.classList.toggle('hidden');
    icon.classList.toggle('fa-bars');
    icon.classList.toggle('fa-times');
}
</script>