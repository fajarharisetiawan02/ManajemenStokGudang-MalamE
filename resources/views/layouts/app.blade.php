<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>@yield('title', 'GudangPro')</title>

    <!-- VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>


<body class="bg-slate-100 font-sans">

    <div class="flex">

        <!-- SIDEBAR -->
        @include('components.sidebar')

        <!-- CONTENT -->
        <div class="ml-72 w-full flex flex-col min-h-screen">

            <!-- NAVBAR -->
            <div class="bg-white shadow px-8 py-4 flex justify-between items-center">

                <!-- TITLE -->
                <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                    @yield('icon')
                    @yield('title', 'Dashboard')
                </h2>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <!-- NOTIF -->
                    <button class="relative bg-slate-100 px-3 py-2 rounded-xl hover:bg-slate-200 transition">
                        <i class="fas fa-bell text-slate-700"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full">
                            3
                        </span>
                    </button>

                    <!-- PROFILE DROPDOWN -->
                    <div class="relative">

                        <!-- BUTTON -->
                        <button id="dropdownUserButton" data-dropdown-toggle="dropdownProfile"
                            class="bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-100 transition">

                            <i class="fas fa-user-circle text-blue-600 text-xl"></i>
                            <span class="font-medium">Admin</span>
                            <i class="fas fa-chevron-down text-sm text-gray-500"></i>
                        </button>

                        <!-- DROPDOWN -->
                        <div id="dropdownProfile"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border z-50">

                            <a href="#" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
                                <i class="fas fa-user text-gray-500"></i> Profil
                            </a>

                            <a href="#" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
                                <i class="fas fa-cog text-gray-500"></i> Pengaturan
                            </a>

                            <a href="/ubah-password"
                                class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
                                <i class="fas fa-key text-yellow-500"></i> Ubah Kata Sandi
                            </a>

                            <hr>

                            <a href="/logout"
                                class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                        </div>

                    </div>

                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8 flex-1">
                @yield('content')
            </div>

            <!-- FOOTER -->
            <footer class="bg-white border-t border-gray-200">

                <div class="container mx-auto px-8 py-10">

                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                        <!-- Bahasa -->
                        <div class="relative inline-block">

                            <!-- BUTTON -->
                            <button onclick="toggleLangMenu()"
                                class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition">

                                <div class="w-10 h-7 rounded overflow-hidden border border-gray-300" id="langFlag">
                                    <div class="h-1/2 bg-red-600"></div>
                                    <div class="h-1/2 bg-white"></div>
                                </div>

                                <span id="currentLangText" class="text-gray-700 font-medium">
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

                        <div class="text-sm text-gray-500 text-center">
                            © 2026 GudangPro Copyright
                        </div>

                    </div>

                </div>

            </footer>

            <!-- SCRIPT KHUSUS HALAMAN -->
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            @yield('script')
</body>

</html>