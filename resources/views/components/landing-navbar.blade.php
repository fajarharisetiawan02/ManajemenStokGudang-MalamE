<nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
    <div class="container mx-auto px-8 h-20 flex justify-between items-center">

        <!-- LOGO -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/LogoGudangPro.png') }}" alt="GudangPro Logo"
                class="h-14 w-auto object-contain brightness-75 contrast-125">
        </a>

        <!-- MENU -->
        <div class="hidden md:flex items-center space-x-8 font-medium text-gray-700 ml-auto mr-10">
            <a href="/home" class="hover:text-blue-700 transition
                {{ request()->is('/') || request()->is('home') ? 'text-blue-700 font-semibold border-b-2 border-blue-700 pb-1' : '' }}">
                {{ __('app.beranda') }}
            </a>
            <a href="/home#keunggulan" class="hover:text-blue-700 transition">
                Fitur
            </a>
        </div>

        <!-- LOGIN -->
        <a href="/login" class="bg-blue-700 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-800 transition">
            {{ __('app.masuk') }}
        </a>

    </div>
</nav>